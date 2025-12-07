<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait UserOwnedItem
{
    /*
        static-ია იმიტომ რო არ სჭირდება ობიექტის შექმნა
    */
    protected static function bootUserOwnedItem(): void
    {
        /*
            static ნიშნავს იმ მოდელს რომელზეც ვიყენებთ ამ ფუნქციას(Trait-ს), ანუ სადაც use გვიწერია
        */
        static::creating(function ($model) {
            
            $isApiRequest = Request::is('api/*');

            if ($isApiRequest) {
                return;
            }

            if (Auth::check() && $model->isFillable('user_id') && is_null($model->user_id)) {
                $model->user_id = Auth::id();
            }
        });
    }
}
