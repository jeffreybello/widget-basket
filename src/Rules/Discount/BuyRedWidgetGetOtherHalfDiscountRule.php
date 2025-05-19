<?php

namespace App\Rules\Discount;

use App\Contracts\DiscountRuleInterface;
use App\Models\Product;

class BuyRedWidgetGetOtherHalfDiscountRule implements DiscountRuleInterface
{
    public function apply(array $items): float
    {
        // Filter only Red Widgets (R01)
        $r01s = array_values(array_filter($items, fn(Product $p) => $p->code === 'R01'));

        $count = count($r01s);

        if ($count < 2) {
            return 0.00;
        }

        // Every 2 R01s → 1 is half price
        $eligibleDiscounts = floor($count/2);
        $price = $r01s[0]->price;

        return $eligibleDiscounts * ($price / 2);
    }
}
