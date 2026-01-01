<?php

namespace App\Models;

use App\Events\Car\CarUpdated;
use App\Observers\CarObserver;
use App\Traits\CheckIfNew;
use App\Traits\LogsActivity;
use App\Traits\UserOwnedItem;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[ObservedBy([CarObserver::class])]
class Car extends Model
{
    use HasFactory, LogsActivity, UserOwnedItem, CheckIfNew;

    protected $dispatchesEvents = [
        'updated' => CarUpdated::class, // car მოდელი ავტომატურად გადაეცემა
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'center_id',
        'user_id',
        'make',
        'model',
        'year',
        'price',
        'description',
        'image',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query) use ($search) {
            return $query->whereAny([
                'make',
                'model',
                'year',
                'description',
                'price',
            ], 'like', '%' . $search . '%');
        });
    }

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

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function center(): belongsTo
    {
        return $this->belongsTo(Center::class);
    }
}
