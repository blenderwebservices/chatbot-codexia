<?php

namespace App\Http\Controllers;

use App\Models\AiAgent;
use Illuminate\Http\Request;
use Laravel\Ai\Facades\Ai;

class BotChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'agent_id' => 'nullable|exists:ai_agents,id',
            'prompt' => 'nullable|string',
            'history' => 'nullable|array',
        ]);

        $systemPrompt = $request->input('prompt', 'Eres un asistente útil y cordial.');
        
        if ($request->filled('agent_id')) {
            $agent = AiAgent::find($request->agent_id);
            if ($agent) {
                $systemPrompt = $agent->system_prompt ?? $systemPrompt;
            }
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
            $response = Ai::withSystemMessage($systemPrompt)->chat($finalMessage);

            return response()->json([
                'success' => true,
                'response' => (string) $response,
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("BotChat Error: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Hubo un error al procesar tu solicitud con la IA.',
            ], 500);
        }
    }
}
