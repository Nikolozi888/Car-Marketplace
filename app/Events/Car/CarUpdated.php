<?php

namespace App\Events\Car;

use App\Actions\Car\UpdateCarAction;
use App\Actions\UnlinkImageAction;
use App\Contracts\Actions\UpdateableInterface;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use App\Services\Car\UpdateImageService;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CarUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Car $car)
    {
        //
    }

}
