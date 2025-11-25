<?php

namespace App\Services\Car;

use App\Jobs\SendNotifications;
use App\Models\Car;
use App\Models\User;

class SendCarCreatedNotificationsService
{
    /**
     * Create a new class instance.
     */
    public function execute(Car $car)
    {
        $users = User::all();
        foreach($users as $person)
        {
            SendNotifications::dispatch($person, $car);
        }
    }
}
