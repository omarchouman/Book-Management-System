<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    public function generateBookDescription(string $title, string $author): ?string
    {
        $prompt = "Write a short, engaging book description for a book titled '{$title}' by '{$author}'.";

        $response = Http::withToken(config('services.openai.key'))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
                'max_tokens' => 100,
                'temperature' => 0.7,
            ]);

        return $response->json('choices')[0]['message']['content'] ?? null;
    }
}
