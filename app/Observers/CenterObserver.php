<?php

namespace App\Observers;

use App\Models\Center;
use App\Notifications\CenterCreated;
use App\Notifications\CenterUpdated;
use Illuminate\Support\Facades\Auth;

class CenterObserver
{
    /**
     * Handle the Center "created" event.
     */
    public function created(Center $center): void
    {
        Auth::user()->notify(new CenterCreated($center));
    }

    /**
     * Handle the Center "updated" event.
     */
    public function updated(Center $center): void
    {
        Auth::user()->notify(new CenterUpdated($center));
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
