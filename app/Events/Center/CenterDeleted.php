<?php

namespace App\Events\Center;

use App\Models\Center;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CenterDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Center $center)
    {
        //
    }
}
