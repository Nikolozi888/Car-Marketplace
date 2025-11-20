<?php

namespace App\Services;

use GuzzleHttp\Client;

class BlogPostGenerator
{
    public function __construct(private AiServiceInterface $aiService)
    {

    }
    public function generate(string $prompt)
    {
        return $this->aiService->generateText($prompt);
    }
}
