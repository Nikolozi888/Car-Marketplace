<?php

namespace App\Services\Car;

use App\Actions\UnlinkImage;
use App\Models\Car;

class UpdateImageService
{
    /**
     * Create a new class instance.
     */
    public function execute($request, Car $car, $unlink)
    {
        if ($request->hasFile('image')) {
            $unlink->handle($car);
            $validated['image'] = $request->file('image')->store('photos', 'public');
        }
    }
}
