<?php

namespace App\Actions\Car;

class DeleteCarAction
{
    /**
     * Create a new class instance.
     */
    public function handle($car)
    {
        $car->delete();
    }
}
