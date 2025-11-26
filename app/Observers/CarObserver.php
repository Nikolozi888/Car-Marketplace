<?php

namespace App\Observers;

use App\Models\Car;
use App\Services\Car\SendCarCreatedNotificationsService;
use App\Actions\UnlinkImageAction;
use Illuminate\Support\Facades\Auth;

class CarObserver
{
    // კონსტრუქტორში ვაკეთებთ სერვისების ინექციას
    public function __construct(
        private SendCarCreatedNotificationsService $sendNotifications,
        private UnlinkImageAction $unlinkImage
    ) {}

    /**
     * სრულდება სანამ მონაცემი ბაზაში ჩაიწერება.
     * აქ შეგვიძლია ავტომატურად მივანიჭოთ ავტორი (User ID).
     */
    public function creating(Car $car): void
    {
        if (Auth::check() && !isset($car->user_id)) {
            $car->user_id = Auth::id();
        }
    }

    /**
     * სრულდება მას შემდეგ, რაც მანქანა წარმატებით შეიქმნა.
     * აქ ვაგზავნით ნოტიფიკაციებს.
     */
    public function created(Car $car): void
    {
        $this->sendNotifications->execute($car);
    }

    /**
     * სრულდება მას შემდეგ, რაც მანქანა წაიშლება ბაზიდან.
     * აქ ვშლით ფიზიკურ ფაილს (სურათს).
     */
    public function deleted(Car $car): void
    {
        $this->unlinkImage->handle($car);
    }
}