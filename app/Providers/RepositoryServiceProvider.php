<?php

namespace App\Providers;

use App\Contracts\Repositories\CarRepositoryInterface;
use App\Contracts\Repositories\CenterRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Repositories\CarRepository;
use App\Repositories\CenterRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CarRepositoryInterface::class, CarRepository::class);
        $this->app->bind(CenterRepositoryInterface::class, CenterRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
