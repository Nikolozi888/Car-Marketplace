<?php

namespace App\Observers;

use App\Events\Car\CarCreatedEvent;
use App\Models\Car;
use App\Services\Car\SendCarCreatedNotificationsService;
use App\Actions\UnlinkImageAction;
use App\Mail\CarUpdatedMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        //
    }

    /**
     * სრულდება მას შემდეგ, რაც მანქანა წარმატებით შეიქმნა.
     * აქ ვაგზავნით ნოტიფიკაციებს.
     */
    public function created(Car $car): void
    {
        $this->sendNotifications->execute($car);

        event(new CarCreatedEvent($car));
    }

    public function updated(): void
    {
        $user = Auth::user();
        Mail::to($user->email)->send(new CarUpdatedMail($user));
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