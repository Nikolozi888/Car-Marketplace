<?php

namespace App\Http\Controllers;

use App\Jobs\ResultsJob;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Mail;

class EmailsController extends Controller
{
   public function welcomeEmail()
    {
        $users = User::all();

        $jobs = [];

        foreach ($users as $user) {
            $jobs[] = new ResultsJob($user);
        }

        $batch = Bus::batch($jobs)->dispatch();

        return $batch->progress() . '%';
    }
}
