<?php

namespace App\Services;

use App\Contracts\DeliveryRuleInterface;
use App\Contracts\DiscountRuleInterface;
use App\Models\Product;

class Basket
{
    /**
     * @var array<string, Product>
     */
    protected array $catalogue;

    /**
     * @var Product[]
     */
    protected array $items = [];

    /**
     * @var DiscountRuleInterface[]
     */
    protected array $discountRules = [];


    public function __construct(array $catalogue, protected ?DeliveryRuleInterface $deliveryRule)
    {
        $this->catalogue = $catalogue;
    }

    public function setDeliveryRule(DeliveryRuleInterface $rule): void
    {
        $this->deliveryRule = $rule;
    }

    public function addDiscountRule(DiscountRuleInterface $rule): void
    {
        $this->discountRules[] = $rule;
    }

    public function add(string $productCode): void
    {
        if (!isset($this->catalogue[$productCode])) {
            throw new \Exception("Product code {$productCode} not found.");
        }

        $this->items[] = $this->catalogue[$productCode];
    }

    protected function calculateDelivery(float $subtotal): float
    {
        if ($this->deliveryRule === null) {
            return 0.0;
        }

        return $this->deliveryRule->calculate($subtotal);
    }

    public function total(): float
    {
        $subtotal = 0.0;

        foreach ($this->items as $product) {
            $subtotal += $product->price;
        }

        // Discount Rule
        $discount = 0.0;
        foreach ($this->discountRules as $rule) {
            $discount += $rule->apply($this->items);
        }
        $subtotal = $subtotal - $discount;

        // Delivery rules
        $delivery = $this->calculateDelivery($subtotal);

        return (float)bcdiv($subtotal + $delivery, 1, 2);
    }
}
