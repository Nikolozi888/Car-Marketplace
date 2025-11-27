<?php

namespace App\Listeners\Car;

use App\Events\Car\DeleteCarEvent;
use App\Models\Car;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogCarDelete
{
    /**
     * Create the event listener.
     */
    public $car;
    public function __construct(DeleteCarEvent $event)
    {
        $this->car = $event->car;
    }

    /**
     * Handle the event.
     */
    public function handle(): void
    {
        Log::info("Car Deleted — ID: {$this->car->id}");
    }
}
