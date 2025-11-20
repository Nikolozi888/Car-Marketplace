<?php

namespace App\Providers;

use App\Models\Car;
use App\Models\User;
use App\Services\AiService;
use App\Services\AiServiceInterface;
use App\Services\BlogPostGenerator;
use App\Services\ClaudeAiService;
use App\Services\ImageGenerator;
use App\Services\OpenAiService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->when(ImageGenerator::class)
                    ->needs(AiServiceInterface::class)
                    ->give(function(){
                        return new ClaudeAiService(new Client(), "020202002");
                    });
        $this->app->when(BlogPostGenerator::class)
                    ->needs(AiServiceInterface::class)
                    ->give(function(){
                        return new OpenAiService(new Client(), "020202002");
                    });
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
