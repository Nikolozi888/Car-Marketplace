<?php

namespace App\Services;

use PhpParser\Node\Stmt\Interface_;

Interface PaymentInterface
{
    public function pay($amount);
}
