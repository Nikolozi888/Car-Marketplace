<?php

namespace App\Actions\Car;

use App\Contracts\Actions\UpdateableInterface;
use App\Models\Car;
use Illuminate\Database\Eloquent\Model;

class UpdateCarAction implements UpdateableInterface
{
    public function handle(Model $car, array $data): Car
    {
        $car->update($data);
        return $car;
    }
}