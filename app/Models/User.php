<?php

namespace App\Models;

use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function carDetail()
    {
        return $this->hasOneThrough(
            CarDetail::class, // საბოლოო მოდელი
            Car::class,       // შუამავალი მოდელი
            'user_id',        // foreign key on cars table
            'car_id',         // foreign key on car_details table
            'id',             // local key on users table
            'id'              // local key on cars table
        );
    }

    public function carDetails()
    {
        return $this->hasManyThrough(
            CarDetail::class, // საბოლოო მოდელი
            Car::class,       // შუამავალი მოდელი
            'user_id',        // foreign key on cars table
            'car_id',         // foreign key on car_details table
            'id',             // local key on users table
            'id'              // local key on cars table
        );
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
