<?php

namespace App\Actions\Center;

use App\Models\Center;

class UpdateCenterAction
{
    /**
     * Create a new class instance.
     */
    public function handle(Center $center, $data)
    {
        $center->update($data);
    }
}
