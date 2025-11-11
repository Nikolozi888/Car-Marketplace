<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarDetail extends Model
{
    public function Car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
