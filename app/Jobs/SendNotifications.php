<?php

namespace App\Jobs;

use App\Notifications\CarCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendNotifications implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $person;
    public $car;
    public function __construct($person, $car)
    {
        $this->person = $person;
        $this->car = $car;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->person->notify(new CarCreated($this->car));
    }
}
