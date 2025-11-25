<?php

namespace App\Actions\Center;

use App\Contracts\Actions\UpdateableInterface;
use App\Models\Center;
use Illuminate\Database\Eloquent\Model;

class UpdateCenterAction implements UpdateableInterface
{
    public function handle(Model $center, array $data): Model
    {
        $center->update($data);
        return $center;
    }
}
