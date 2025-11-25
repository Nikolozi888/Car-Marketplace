<?php

namespace App\Actions\Car;

use App\Contracts\Actions\CreateableInterface;
use App\Models\Car;

class CreateCarAction implements CreateableInterface
{
    public function handle(array $data): Car
    {
        return Car::create($data);
    }
}
