<?php

namespace App\Providers;

use App\Events\CarUpdated;
use App\Listeners\LogCarUpdate;
use App\Listeners\SendCarUpdatedNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        CarUpdated::class => [
            LogCarUpdate::class,
            SendCarUpdatedNotification::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
