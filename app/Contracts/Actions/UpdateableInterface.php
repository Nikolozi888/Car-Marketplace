<?php

namespace App\Contracts\Actions;

use App\Models\Car;
use Illuminate\Database\Eloquent\Model;

interface UpdateableInterface 
{
    public function handle(Model $model, array $data): Model;
}