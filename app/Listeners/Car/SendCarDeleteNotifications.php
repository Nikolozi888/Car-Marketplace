<?php

namespace App\Listeners\Car;

use App\Events\Car\DeleteCarEvent;
use App\Notifications\CarDeletedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCarDeleteNotifications
{
    public function handle(DeleteCarEvent $event): void
    {
        $event->car->user->notify(new CarDeletedNotification($event->car));
    }
}
