<?php

namespace App\Services;

use GuzzleHttp\Client;

interface AiServiceInterface
{
    public function generateText(string $prompt);

    public function generateImage(string $prompt);
}
