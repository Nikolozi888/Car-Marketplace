<?php

namespace App\Contracts\Repositories;

interface CarRepositoryInterface
{
    public function getPaginatedCars(?string $search = null, int $perPage = 15);
}
