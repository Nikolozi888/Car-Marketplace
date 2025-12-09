<?php

namespace App\Traits;

use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\UploadedFile as UserUploadedFile;
use Illuminate\Support\Facades\Storage;

trait ImageManagerTrait
{
    public function __construct()
    {
        //
    }

    public function uploadImage($image, string $disk = 'public', string $path = 'photos'): ?string
    {
        $filename = time() . '_' . str_replace(' ', '_', $image->getClientOriginalName());

        $filePath = $image->storeAs($path, $filename, $disk);
                                //  photos 4BVgTu.jpg public

        return $filePath;
    }


    public function updateImage(UserUploadedFile $newImage, ?string $oldImagePath = null, string $disk = 'public', string $path = 'photos'): ?string
    {
        if ($oldImagePath) {
            $this->deleteImage($oldImagePath, $disk);
        }

        return $this->uploadImage($newImage, $path, $disk);
    }

    public function deleteImage(string $filePath, string $disk = 'public'): bool
    {
        return Storage::disk($disk)->exists($filePath) ? Storage::disk($disk)->delete($filePath) : false;
    }

}
