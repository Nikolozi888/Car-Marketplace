<?php

namespace App\Services\Car;

use App\Models\Car;
use App\Traits\ImageManagerTrait;

class AddImageService
{
    use ImageManagerTrait;
    
    public function execute($request, Car $car): void
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $uploadedFile = $request->file('image');
            $imagePath = $this->uploadImage($uploadedFile, 'public', 'photos');
            
            if ($imagePath) {
                $car->images()->create([
                    'path' => $imagePath,
                ]);
            }
        }
    }
}