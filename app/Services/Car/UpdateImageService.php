<?php

namespace App\Services\Car;

use App\Actions\UnlinkImage;
use App\Actions\UnlinkImageAction;
use App\Models\Car;

class UpdateImageService
{
    public function __construct(private UnlinkImageAction $unlink)
    {
        
    }
    /**
     * Create a new class instance.
     */
    public function execute($request, Car $car)
    {
        if ($request->hasFile('image')) {
            $this->unlink->handle($car);
            $validated['image'] = $request->file('image')->store('photos', 'public');
        }
    }
}
