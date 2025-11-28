<?php

namespace App\Listeners\Car;

use App\Events\Car\CarCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogCarCreated
{
    public function handle(CarCreatedEvent $event): void
    {
        Log::info("Car Created Successfully -- ID {$event->car->id}");
    }
}
