<?php

namespace App\Repositories;

use App\Models\Car;

class CarRepository
{
    public function getPaginatedCars(?string $search = null, int $perPage = 15)
    {
        return Car::search($search)
            ->with('detail')
            ->paginate($perPage);
    }
}
