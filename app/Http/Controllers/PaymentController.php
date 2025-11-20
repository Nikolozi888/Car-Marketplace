<?php

namespace App\Http\Controllers;

use App\Services\PaymentInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(PaymentInterface $payment)
    {
        return $payment->pay(100);
    }
}
