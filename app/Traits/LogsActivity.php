<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LogsActivity
{
    /* 
        როდესაც ფუნქციას სახელში უწერია boot ის ავტომატურად შესრულდება,
        მაგრამ რა თქმა უნდა შეგვიძლია არ დავაწეროთ boot მაგრამ მაშინ ის უნდა გამოვიძახოთ
    */
    /*
        static-ია იმიტომ რო არ სჭირდება ობიექტის შექმნა
    */
    public static function bootLogsActivity()
    {
        /*
            static:: (Late Static Binding) უზრუნველყოფს, რომ ეს მოვლენები მიბმული იყოს იმ კონკრეტულ მოდელზე, რომელიც იყენებს ამ ტრეიტს.
            ანუ აქ static ნიშნავს იმ მოდელს რომელზეც ვიძახებთ ამ ფუნქციას
        */
        static::created(function ($model) {
            Log::info('Created: ' . get_class($model) . ' ID -- ' . $model->id);
        });

        static::updated(function ($model) {
            Log::info('Updated: ' . get_class($model) . ' ID -- ' . $model->id);
        });

        static::deleted(function ($model) {
            Log::info('Deleted: ' . get_class($model) . ' ID -- ' . $model->id);
        });
    }
}
