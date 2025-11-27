<?php

namespace App\Providers;

use App\Events\Car\CarUpdated;
use App\Events\Car\DeleteCarEvent;
use App\Events\Center\CenterCreated;
use App\Events\Center\CenterDeleted;
use App\Listeners\Car\LogCarDelete;
use App\Listeners\Car\LogCarUpdate;
use App\Listeners\Car\SendCarDeleteNotifications;
use App\Listeners\Car\SendCarUpdatedNotification;
use App\Listeners\Center\LogCenterCreate;
use App\Listeners\Center\LogCenterDeleted;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        CarUpdated::class => [
            LogCarUpdate::class,
            SendCarUpdatedNotification::class,
        ],
        DeleteCarEvent::class => [
            LogCarDelete::class,
            SendCarDeleteNotifications::class,
        ],

        CenterCreated::class => [
            LogCenterCreate::class,
        ],
        CenterDeleted::class => [
            LogCenterDeleted::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
