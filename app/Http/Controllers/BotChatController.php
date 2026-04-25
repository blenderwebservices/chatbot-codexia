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
            'agent_id' => 'required|exists:ai_agents,id',
        ]);

        $agent = AiAgent::findOrFail($request->agent_id);

        $response = Ai::withSystemMessage($agent->system_prompt)
            ->withModel($agent->model)
            ->chat($request->message);

        return response()->json([
            'response' => $response,
        ]);
    }
}
