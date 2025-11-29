<?php

namespace App\Contracts\Repositories;

use App\Models\Center;

interface CenterRepositoryInterface
{
    public function getPaginatedCenters(int $perPage = 10);
    public function updateCenter(Center $center, array $data);
    public function deleteCenter(Center $center);
}
