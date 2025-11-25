<?php

namespace App\Actions\Car;

use App\Contracts\Actions\DeleteableInterface;
use App\Models\Car;
use Illuminate\Database\Eloquent\Model;

class DeleteCarAction implements DeleteableInterface
{
    public function handle(Model $car): bool
    {
        return $car->delete();
    }
}
