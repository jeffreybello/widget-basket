<?php

namespace App\Contracts;

interface DeliveryRuleInterface
{
    public function calculate(float $subtotal): float;
}
