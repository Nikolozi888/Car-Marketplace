<?php

namespace App\Actions\Center;

use App\Models\Center;

class DeleteCenterAction
{
    /**
     * Create a new class instance.
     */
    public function handle(Center $center)
    {
        $center->delete();
    }
}
