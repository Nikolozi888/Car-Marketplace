<?php

namespace App\Listeners\Center;

use App\Events\Center\CenterCreated;
use App\Models\Car;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogCenterCreate
{
    public function handle(CenterCreated $event): void
    {
        Log::info("Center Created — ID: {$event->center->id}");
    }
}
