<?php

namespace App\Rules\Delivery;

use App\Contracts\DeliveryRuleInterface;

class StandardDeliveryRule implements DeliveryRuleInterface
{
    public function calculate(float $subtotal): float
    {
        if ($subtotal >= 90) {
            return 0.00;
        }

        if ($subtotal >= 50) {
            return 2.95;
        }

        return 4.95;
    }
}
