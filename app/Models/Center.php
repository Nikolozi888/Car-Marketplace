<?php

namespace App\Models;

use App\Observers\CenterObserver;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([CenterObserver::class])]
class Center extends Model
{
    use LogsActivity;
    
    protected $guarded = [];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
