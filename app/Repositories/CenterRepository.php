<?php

namespace App\Repositories;

use App\Contracts\Repositories\CenterRepositoryInterface;
use App\Models\Center;

class CenterRepository implements CenterRepositoryInterface
{
    public function getPaginatedCenters(int $perPage = 10)
    {
        return Center::latest()->paginate($perPage);
    }

    public function updateCenter(Center $center, array $data)
    {
        $center->update($data);
    }

    public function deleteCenter(Center $center)
    {
        $center->delete();
    }
}
