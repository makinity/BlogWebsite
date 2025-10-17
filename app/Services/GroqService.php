<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class GroqService
{
    public function chat(array $messages, string $model = 'openai/gpt-oss-20b')
    {
        $apiKey = config('services.groq.key');
        $base = config('services.groq.base_uri');

        $response = Http::withToken($apiKey)
            ->post("$base/chat/completions", [
                'model' => $model,
                'messages' => $messages,
            ]);

        // Check for non-200 or errors
        if (! $response->successful()) {
            throw new Exception("Groq API request failed: " . $response->body());
        }

        $data = $response->json();

        return $data['choices'][0]['message']['content'] ?? null;
    }
}
