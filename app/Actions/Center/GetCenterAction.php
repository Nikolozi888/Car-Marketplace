<?php

namespace App\Actions\Center;

use App\Models\Center;

class GetCenterAction
{
    public function handle()
    {
        return Center::latest()->paginate(10);
    }
}