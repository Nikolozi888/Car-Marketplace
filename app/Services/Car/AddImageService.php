<?php

namespace App\Services\Car;

use App\Models\Car;

class AddImageService
{
    public function execute($request, Car $car)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('photos', 'public');
            // ვქმნით image ჩანაწერს polymorphic კავშირის მიხედვით
            $car->images()->create([
                'path' => $imagePath,
            ]);
        }
    }
}