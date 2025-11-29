<?php

namespace App\Contracts\Repositories;

use App\Models\Car;

interface CarRepositoryInterface
{
    public function getPaginatedCars(?string $search = null, int $perPage = 15);
    public function createCar(array $data): Car;
}
