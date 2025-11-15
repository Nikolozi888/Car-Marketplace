<?php

namespace App\Providers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate::define('edit-car', function(User $user, Car $car){
        //     return $car->user == $user;
        // });

        // Gate::define('delete-car', function(User $user, Car $car){
        //     return $car->user == $user;
        // });
    }
}
