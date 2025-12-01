<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait UserOwnedItem
{
    protected static function bootUserOwnedItem(): void
    {
        static::creating(function ($model) {
            if (Auth::check() && $model->isFillable('user_id') && is_null($model->user_id)) {
                $model->user_id = Auth::id();
            }
        });
    }
}
