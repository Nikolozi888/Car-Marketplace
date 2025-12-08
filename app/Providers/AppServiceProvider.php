<?php

namespace App\Providers;

use App\Models\Car;
use App\Models\User;
use App\Services\AiService;
use App\Services\AiServiceInterface;
use App\Services\BlogPostGenerator;
use App\Services\Car\ImageService;
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
        /*
            აქ ვიყენებთ contextual binding-ს (when), რათა სხვადასხვა კლასს
            სხვადასხვა AiService მივაწოდოთ.

            რადგან ქვემოთ ეს სერვისები singleton-ად გვაქვს რეგისტრირებული,
            give(ClaudeAiService::class) ავტომატურად resolve-დება singleton-იდან.
        */
        $this->app->when(ImageGenerator::class)
            ->needs(AiServiceInterface::class)
            ->give(ClaudeAiService::class);
            
        $this->app->when(BlogPostGenerator::class)
            ->needs(AiServiceInterface::class)
            ->give(OpenAiService::class);
            

        /*
            აქ უკვე ვუთითებ მნიშვნელობებს singleton-ით, 
            singleton-ით იმიტომ რომ სადაც გამოვიყენებთ ამ სერვისებს ყველგან ერთნაირი დაგვჭირდება, იგივე ApiKey-ით და იგივე Client-ით
        */
        $this->app->singleton(ClaudeAiService::class, fn () => new ClaudeAiService(new Client(), "020202002"));
        $this->app->singleton(OpenAiService::class, fn () => new OpenAiService(new Client(), "020202002"));


        /*
            instance() არის singleton-პატერნის პირდაპირი გამოხატვა, მაგრამ შენ ქმნი ობიექტს და container-ში პირდაპირ ინახავ.
            ანუ ცვლადში შენახული ობიექტის გამოყენება არის instance
        */
        $imageService = new ImageService();

        $this->app->instance(ImageService::class, $imageService);
        $this->app->alias(ImageService::class, 'image.manager');

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
