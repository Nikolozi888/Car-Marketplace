<?php

namespace App\Contracts\Actions;

use App\Models\Car;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

interface CreateableInterface {
    public function handle(array $data): Model;
}
