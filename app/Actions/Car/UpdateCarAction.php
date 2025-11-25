<?php

namespace App\Actions\Car;

class UpdateCarAction
{
    /**
     * Create a new class instance.
     */
    public function handle($car, $data)
    {
        $car->update($data);
    }
}
