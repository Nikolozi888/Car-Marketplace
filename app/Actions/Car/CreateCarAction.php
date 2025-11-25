<?php

namespace App\Actions\Car;

use App\Models\Car;

class CreateCarAction
{
    /**
     * Create a new class instance.
     */
    public function handle($data)
    {
        $car = Car::create($data);
        return $car;
    }
}
