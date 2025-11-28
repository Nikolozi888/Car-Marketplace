<?php

namespace App\Listeners\Center;

use App\Events\Center\CenterUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogCenterUpdated
{
    /**
     * Handle the event.
     */
    public function handle(CenterUpdated $event): void
    {
        Log::info("Center Updated Successfully -- ID {$event->center->id}");
    }
}
