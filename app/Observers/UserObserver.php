<?php

namespace App\Observers;

use App\Mail\DeleteUserEmail;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    public function __construct()
    {}

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        try {
            Mail::to($user->email)->send(new WelcomeEmail($user));
        } catch (\Exception $e) {
            Log::error("Welcome email failed for user {$user->id}: " . $e->getMessage());
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        try {
            Mail::to($user->email)->send(new DeleteUserEmail($user));
        } catch (\Exception $e) {
            Log::error("delete email failed for user {$user->id}: " . $e->getMessage());
        }
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
