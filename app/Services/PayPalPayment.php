<?php

namespace App\Services;

class PayPalPayment implements PaymentInterface
{
    public function pay($amount)
    {
        return "From Your PayPal Account paid $amount dollars";
    }
}
