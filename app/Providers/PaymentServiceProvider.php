<?php

namespace App\Providers;

use App\Services\PaymentInterface;
use App\Services\PayPalPayment;
use App\Services\StripePayment;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentInterface::class, PayPalPayment::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
