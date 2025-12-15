<?php

namespace App\Repositories;

use App\Contracts\Repositories\CarRepositoryInterface;
use App\Models\Car;

class CarRepository implements CarRepositoryInterface
{
    public function getPaginatedCars(?string $search = null, int $perPage = 3)
    {
        return Car::search($search)
            ->with('detail')->latest()
            ->paginate($perPage);
    }

    public function createCar(array $data): Car
    {
        return Car::create($data);
    }
}
