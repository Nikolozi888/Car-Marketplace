<?php

namespace App\Actions;

use Illuminate\Support\Facades\Mail;

class SendMail
{
    public function handle($email, $instance)
    {
        Mail::to($email)->send($instance);
    }
}