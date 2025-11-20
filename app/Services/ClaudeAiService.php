<?php

namespace App\Services;

use GuzzleHttp\Client;

class ClaudeAiService implements AiServiceInterface
{
    public function __construct(private Client $client, string $apiKey)
    {

    }

    public function generateText(string $prompt)
    {     
        return "Claude Generated text for: $prompt";
    }

    public function generateImage(string $prompt)
    {
        return "Claude Generated text for: $prompt";
    }
}
