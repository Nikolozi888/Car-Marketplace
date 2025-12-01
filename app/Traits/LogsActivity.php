<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LogsActivity
{
    /* 
        როდესაც ფუნქციას სახელში უწერია boot ის ავტომატურად შესრულდება,
        მაგრამ რა თქმა უნდა შეგვიძლია არ დავაწეროთ boot მაგრამ მაშინ ის უნდა გამოვიძახოთ
    */
    public static function bootLogsActivity()
    {
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
