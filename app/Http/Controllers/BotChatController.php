<?php

namespace App\Http\Controllers;

use App\Models\AiProvider;
use App\Models\Chatbot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function Laravel\Ai\agent;

class BotChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'provider_id' => 'nullable|exists:ai_providers,id',
            'chatbot_id' => 'nullable|exists:chatbots,id',
            'prompt' => 'nullable|string',
            'history' => 'nullable|array',
        ]);

        $providerRecord = null;
        
        if ($request->filled('chatbot_id')) {
            $chatbot = Chatbot::with(['provider.vendor', 'provider.aiModel'])->find($request->chatbot_id);
            $providerRecord = $chatbot?->provider;
        } elseif ($request->filled('provider_id')) {
            $providerRecord = AiProvider::with(['vendor', 'aiModel'])->find($request->provider_id);
        } else {
            $providerRecord = AiProvider::with(['vendor', 'aiModel'])->where('is_default', true)->first() ?? AiProvider::with(['vendor', 'aiModel'])->first();
        }

        if (!$providerRecord) {
            return response()->json([
                'success' => false,
                'error' => 'No se encontró una configuración de IA válida.',
            ], 404);
        }

        $systemPrompt = $providerRecord->system_prompt ?? $request->input('prompt', 'Eres un asistente útil y cordial.');

        // Get driver and model keys from relationships
        $driver = $providerRecord->vendor->key;
        $model = $providerRecord->aiModel->key;

        // Map "google" vendor key to "gemini" driver if necessary (laravel/ai specific)
        if ($driver === 'google') {
            $driver = 'gemini';
        }

        // Dynamically configure the provider with the API key from DB
        if ($providerRecord->api_key) {
            config([
                "ai.providers.{$driver}" => [
                    'driver' => $driver,
                    'key' => $providerRecord->api_key,
                ]
            ]);
        }

        $historyText = "";
        if ($request->filled('history')) {
            foreach ($request->input('history') as $msg) {
                $role = isset($msg['role']) && $msg['role'] == 'user' ? 'Usuario' : 'Asistente';
                $content = $msg['content'] ?? '';
                $historyText .= "{$role}: {$content}\n";
            }
        }

        $finalMessage = $request->message;
        if (!empty($historyText)) {
            $finalMessage = "Historial de la conversación:\n" . $historyText . "\n\nNuevo mensaje del Usuario:\n" . $request->message;
        }

        try {
            $aiAgent = agent($systemPrompt);
            $response = $aiAgent->prompt(
                $finalMessage,
                provider: $driver,
                model: $model
            );

            return response()->json([
                'success' => true,
                'response' => (string) $response,
            ]);
        } catch (\Exception $e) {
            Log::error("BotChat Error: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Hubo un error al procesar tu solicitud con la IA: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getConfig(Chatbot $chatbot)
    {
        return response()->json([
            'success' => true,
            'name' => $chatbot->name,
            'color' => $chatbot->color,
            'position' => $chatbot->position,
            'welcome_message' => $chatbot->welcome_message,
        ]);
    }
}
