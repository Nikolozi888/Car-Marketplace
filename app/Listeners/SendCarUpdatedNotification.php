<?php

namespace App\Listeners;

use App\Events\CarUpdated;
use App\Notifications\CarUpdatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCarUpdatedNotification
{
    public function handle(CarUpdated $event): void
    {
        $event->car->user->notify(new CarUpdatedNotification($event->car));
    }
}
