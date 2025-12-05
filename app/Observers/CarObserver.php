<?php

namespace App\Observers;

use App\Events\Car\CarCreatedEvent;
use App\Models\Car;
use App\Services\Car\SendCarCreatedNotificationsService;
use App\Actions\UnlinkImageAction;
use App\Mail\CarUpdatedMail;
use App\Traits\ImageManagerTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class CarObserver
{
    use ImageManagerTrait;

    public function __construct(
        private SendCarCreatedNotificationsService $sendNotifications,
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

        Event::dispatch(new CarCreatedEvent($car));
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
        $this->deleteImage($car->image, 'public');
    }
}