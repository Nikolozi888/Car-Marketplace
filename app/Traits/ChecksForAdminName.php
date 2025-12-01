<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait ChecksForAdminName
{
    public function applyAdmin(array $data): array
    {
        if (Arr::exists($data, 'name') && strtolower($data['name']) === 'admin') {
            $data['is_admin'] = 1;
        } else {
            $data['is_admin'] = 0;
        }

        return $data;
    }
}
