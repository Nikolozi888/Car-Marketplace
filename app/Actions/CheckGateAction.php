<?php

namespace App\Actions;

use Illuminate\Support\Facades\Gate;

class CheckGateAction
{
    /**
     * Create a new class instance.
     */
    public function handle($action, $model)
    {
        Gate::authorize($action, $model);
    }
}
