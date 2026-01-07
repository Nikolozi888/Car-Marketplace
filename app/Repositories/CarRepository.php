<?php

namespace App\Repositories;

use App\Contracts\Repositories\CarRepositoryInterface;
use App\Models\Car;
use Illuminate\Http\Request;

class CarRepository implements CarRepositoryInterface
{
    public function getPaginatedCars(?string $search = null, int $perPage = 3)
    {
        $sort = request()->get('sort', '');

        switch($sort) {
            case'name-asc':
                $sortColumn = 'make';
                $sortDirection = 'asc';
                break;
            case 'name-desc':
                $sortColumn = 'make';
                $sortDirection = 'desc';
                break;
            case 'price-asc':
                $sortColumn = 'price';
                $sortDirection = 'asc';
                break;
            case 'price-desc':
                $sortColumn = 'price';
                $sortDirection = 'desc';
                break;
            default:
                $sortColumn = 'id';
                $sortDirection = 'desc';

        }

        return Car::search($search)
            ->with('detail')->orderBy($sortColumn, $sortDirection)->paginate($perPage);
    }

    public function createCar(array $data): Car
    {
        return Car::create($data);
    }
}
