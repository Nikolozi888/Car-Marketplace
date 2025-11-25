<?php

namespace App\Contracts\Services;

use Illuminate\Http\RedirectResponse;

interface CreateableInterface
{
    public function store(): RedirectResponse;
}
