<?php

namespace App\Actions\Center;

use App\Contracts\Actions\CreateableInterface;
use App\DTOs\CenterDTO;
use App\Models\Center;
use Illuminate\Database\Eloquent\Model;

class CreateCenterAction implements CreateableInterface
{
    public function handle(array $data): Model
    {
        return Center::create($data);
    }
}
