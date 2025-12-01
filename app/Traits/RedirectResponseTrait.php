<?php

namespace App\Traits;

trait RedirectResponseTrait
{
    public function successRedirect(string $route, string $message, $param = null)
    {
        return redirect()->route($route, $param)->with('success', $message);
    }


    public function errorRedirect($route, $message="დაფიქსირდა შეცდომა!", $param = null)
    {
        return redirect()->route($route, $param)->with('error', $message);
    }
}
