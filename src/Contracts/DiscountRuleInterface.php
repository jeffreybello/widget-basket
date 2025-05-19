<?php

namespace App\Contracts;

use App\Models\Product;

interface DiscountRuleInterface
{
    /**
     * @param Product[] $items
     * @return float Total discount to apply
     */
    public function apply(array $items): float;
}
