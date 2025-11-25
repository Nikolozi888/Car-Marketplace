<?php

namespace App\Actions\Center;

use App\Contracts\Actions\DeleteableInterface;
use App\Models\Center;
use Illuminate\Database\Eloquent\Model;

class DeleteCenterAction implements DeleteableInterface
{
    public function handle(Model $center): bool
    {
        return $center->delete();
    }
}
