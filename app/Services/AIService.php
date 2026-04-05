<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIService
{
    public function generateSteps($task)
    {

        $systemRole  = config('ai.prompts.atomize_engine');

        $response = Http::timeout(300)
            ->withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY_DEV'),
                'Content-Type' => 'application/json'
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                "model" => "openai/gpt-oss-120b",
                "messages" => [
                    [
                        "role" => "system",
                        "content" => $systemRole,
                    ],
                    [
                        "role" => "user",
                        "content" => $task
                    ]
                ],
            ]);

        $data = $response->json();

        if (!isset($data['choices'])) {
            return [
                "error" => $data
            ];
        }

        return $data['choices'][0]['message']['content'];
    }
}
