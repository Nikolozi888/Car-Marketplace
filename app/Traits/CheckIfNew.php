<?php

namespace App\Traits;

use Carbon\Carbon;

trait CheckIfNew
{
    public function getAgeAttribute(): int
    {
        if (!isset($this->year)) {
            return 0;
        }

        return Carbon::now()->year - $this->year;
    }
 
    public function isNew(): bool
    {
        return $this->age <= 5;
    }

    public function getStatusAttribute(): string
    {
        return $this->isNew() ? 'brand new' : 'used';
    }
}
