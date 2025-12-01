<?php

namespace App\Services\Car;

use App\Actions\UnlinkImage;
use App\Actions\UnlinkImageAction;
use App\Models\Car;
use App\Traits\ImageManagerTrait;

class UpdateImageService
{
    use ImageManagerTrait;

    public function execute($request, Car $car): void
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $oldImagePath = $car->image; 
            $newPath = $this->updateImage($request->file('image'), $oldImagePath, 'public', 'photos' );
            $request['image'] = $newPath;
        }
    }
}
