<?php

namespace App\Services;

class StripePayment implements PaymentInterface
{
    public function pay($amount)
    {
        return "From Your Stripe Account paid $amount dollars";
    }
}
