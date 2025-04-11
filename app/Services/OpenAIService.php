<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    public function generateBookDescription(string $title, string $author): ?string
    {
        $prompt = "Write a short, engaging book description for a book titled '{$title}' by '{$author}'.";

        return $this->callOpenAI($prompt, 100, 0.7);
    }

    public function generateBookTags(string $title, string $description): array
    {
        $prompt = "Suggest 1 to 2 genre or thematic tags for a book titled '{$title}'
                   with this description: {$description}. Return only a comma-separated list of lowercase tags.";

        $tagsText = $this->callOpenAI($prompt, 60, 0.5);

        return array_map('trim', explode(',', strtolower($tagsText)));
    }

    protected function callOpenAI(string $prompt, int $maxTokens, float $temperature): ?string
    {
        $response = Http::withToken(config('services.openai.key'))
            ->timeout(60)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
                'max_tokens' => $maxTokens,
                'temperature' => $temperature,
            ]);

        return $response->json('choices')[0]['message']['content'] ?? null;
    }
}
