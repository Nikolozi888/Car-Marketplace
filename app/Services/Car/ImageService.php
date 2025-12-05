<?php

namespace App\Services\Car;

use App\Traits\ImageManagerTrait;

class ImageService
{
    use ImageManagerTrait;
    public function add($request, $car)
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

    public function update($request, $car)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $oldImagePath = $car->image; 
            $newPath = $this->updateImage($request->file('image'), $oldImagePath, 'public', 'photos' );
            $request['image'] = $newPath;
        }
    }
}
