<?php

namespace App\Repositories;

use App\Contracts\Repositories\CarRepositoryInterface;
use App\Models\Car;

class CarRepository implements CarRepositoryInterface
{
    public function getPaginatedCars(?string $search = null, int $perPage = 15)
    {
        return Car::search($search)
            ->with('detail')
            ->paginate($perPage);
    }

    public function createCar(array $data): Car
    {
        return Car::create($data);
    }
}
