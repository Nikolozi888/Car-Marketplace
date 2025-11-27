<?php

namespace App\Listeners;

use App\Events\CarUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogCarUpdate
{
    public function handle(CarUpdated $event): void
    {
        Log::info("Car updated — ID: {$event->car->id}");
    }
}
