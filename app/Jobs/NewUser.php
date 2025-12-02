<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Batchable;
use App\Notifications\NewUser as NewUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class NewUser implements ShouldQueue
{
    use Queueable, Batchable;

    public function __construct()
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $admins = User::where('is_admin', 1)->get();

        foreach($admins as $admin)
        {
            $admin->notify(new NewUserNotification());
        }
    }
}
