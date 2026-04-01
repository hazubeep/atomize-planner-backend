<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIService
{
    public function generateSteps($task)
    {

        $systemRole  = <<<EOT
Identitas: Anda adalah "Atomize Intelligence Engine".
Tugas: Mentransformasi input mentah user menjadi rencana kerja profesional yang mendalam.

Instruksi Output:
1. Main Task: Buat 'title' yang profesional dan 'description' yang menjelaskan tujuan akhir (goal) dari tugas tersebut.
2. Task Steps: Pecah menjadi 5-8 langkah teknis. Setiap langkah wajib memiliki 'title' (instruksi singkat) dan 'description' (penjelasan cara mengeksekusi langkah tersebut secara spesifik).
3. DURASI: Berikan estimasi waktu dalam menit untuk tiap langkah.
4. LARANGAN: Jangan ada kalimat pembuka/penutup. Langsung berikan JSON.

Format Output WAJIB JSON murni:
{
  "task": {
    "title": "Judul Polesan AI",
    "description": "Deskripsi konteks/tujuan utama tugas"
  },
  "task_steps": [
    {
      "title": "Judul Langkah Teknis",
      "description": "Detail penjelasan cara melakukan langkah ini",
      "estimated_duration": 15
    }
  ]
}
EOT;

        $response = Http::timeout(300)
            ->withHeaders([
                'Authorization' => 'Bearer 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',
                'Content-Type' => 'application/json'
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                "model" => "qwen/qwen3.6-plus-preview:free",
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
