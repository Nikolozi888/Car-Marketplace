<?php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAiService implements AiServiceInterface
{
    public function __construct(private Client $client, string $apiKey)
    {

    }

    public function generateText(string $prompt)
    {     
        return "OpenAi Generated text for: $prompt";
    }

    public function generateImage(string $prompt)
    {
        return "OpenAi Generated text for: $prompt";
    }
}
