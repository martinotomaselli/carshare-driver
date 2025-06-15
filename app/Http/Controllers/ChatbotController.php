<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function __invoke(Request $request)
    {
        $question = $request->input('message');

        // chiamata al servizio FastAPI
        $response = Http::timeout(15)
            ->post(config('services.fastapi.url').'/chat', [
                'question' => $question,
            ]);

        if ($response->failed()) {
            return response()->json([
                'reply' => 'Il servizio non è al momento disponibile.'
            ], 502);
        }

        return response()->json([
            'reply' => $response->json('reply'),
        ]);
    }
}
