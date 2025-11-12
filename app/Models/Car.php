<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'make',
        'model',
        'year',
        'price',
        'description',
        'image',
    ];

    public function detail()
    {
        return $this->hasOne(CarDetail::class, 'car_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'car_feature');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
