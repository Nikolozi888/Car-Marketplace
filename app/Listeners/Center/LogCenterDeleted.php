<?php

namespace App\Listeners\Center;

use App\Events\Center\CenterDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogCenterDeleted
{
    public function handle(CenterDeleted $event): void
    {
        Log::info("Center Deleted — ID: {$event->center->id}");
    }
}
