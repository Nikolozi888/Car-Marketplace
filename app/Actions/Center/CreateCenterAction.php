<?php

namespace App\Actions\Center;

use App\Models\Center;

class CreateCenterAction
{
    public function handle($data)
    {
        $center = Center::create($data);
        return $center;
    }
}
