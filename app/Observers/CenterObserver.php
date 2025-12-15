<?php

namespace App\Observers;

use App\Events\Center\CenterUpdated as CenterUpdatedEvent;
use App\Models\Center;
use App\Notifications\CenterCreated;
use App\Notifications\CenterUpdated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class CenterObserver
{
    /**
     * Handle the Center "created" event.
     */
    public function created(Center $center): void
    {
        current_user()->notify(new CenterCreated($center));
    }

    /**
     * Handle the Center "updated" event.
     */
    public function updated(Center $center): void
    {
        current_user()->notify(new CenterUpdated($center));

        Event::dispatch(new CenterUpdatedEvent($center));
    }

    /**
     * Handle the Center "deleted" event.
     */
    public function deleted(Center $center): void
    {
        //
    }

    /**
     * Handle the Center "restored" event.
     */
    public function restored(Center $center): void
    {
        //
    }

    /**
     * Handle the Center "force deleted" event.
     */
    public function forceDeleted(Center $center): void
    {
        //
    }
}
