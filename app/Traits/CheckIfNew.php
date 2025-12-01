<?php

namespace App\Traits;

use Carbon\Carbon;

trait CheckIfNew
{
    public function isNew()
    {
        // $this არის ობიექტი რომელზე ხდება ამ ფუნქციის გამოძახება
        if (!isset($this->year)) {
            return false;
        }

        $currentYear = Carbon::now()->year;

        return ($currentYear - $this->year) <= 5;
    }
}
