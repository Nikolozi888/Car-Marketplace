<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;

class FileExists
{
    public function handle(string $filePath, string $disk): bool
    {
        return Storage::disk($disk)->exists($filePath);
    }
}
