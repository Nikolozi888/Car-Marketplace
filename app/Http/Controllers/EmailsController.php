<?php

namespace App\Http\Controllers;

use App\Jobs\ResultsJob;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailsController extends Controller
{
    public function welcomeEmail()
    {
        $users = User::all();

        foreach ($users as $user) {
            ResultsJob::dispatch($user);
        }

        return 'Emails Sent Successfully';
    }
}
