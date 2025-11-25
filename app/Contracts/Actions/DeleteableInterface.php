<?php

namespace App\Contracts\Actions;

use App\Models\Car;
use Illuminate\Database\Eloquent\Model;

interface DeleteableInterface 
{
    public function handle(Model $model): bool;
}