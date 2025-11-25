<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contracts\Actions\CreateableInterface;
use App\Contracts\Actions\UpdateableInterface;
use App\Contracts\Actions\DeleteableInterface;
use App\Actions\Car\CreateCarAction;
use App\Actions\Car\UpdateCarAction;
use App\Actions\Car\DeleteCarAction;
use App\Actions\Center\CreateCenterAction;
use App\Actions\Center\UpdateCenterAction;
use App\Actions\Center\DeleteCenterAction;

use App\Http\Controllers\CarController;
use App\Http\Controllers\CarCenterController;

class ActionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        $this->app->when(CarController::class)
            ->needs(CreateableInterface::class)
            ->give(CreateCarAction::class);

        $this->app->when(CarController::class)
            ->needs(UpdateableInterface::class)
            ->give(UpdateCarAction::class);

        $this->app->when(CarController::class)
            ->needs(DeleteableInterface::class)
            ->give(DeleteCarAction::class);





        $this->app->when(CarCenterController::class)
            ->needs(CreateableInterface::class)
            ->give(CreateCenterAction::class);

        $this->app->when(CarCenterController::class)
            ->needs(UpdateableInterface::class)
            ->give(UpdateCenterAction::class);

        $this->app->when(CarCenterController::class)
            ->needs(DeleteableInterface::class)
            ->give(DeleteCenterAction::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
