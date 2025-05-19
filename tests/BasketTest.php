<?php

use PHPUnit\Framework\TestCase;
use App\Services\Basket;
use App\Models\Product;
use App\Rules\Delivery\StandardDeliveryRule;
use App\Rules\Discount\BuyRedWidgetGetOtherHalfDiscountRule;

class BasketTest extends TestCase
{
    private function getCatalogue(): array
    {
        return [
            'R01' => new Product('R01', 'Red Widget', 32.95),
            'G01' => new Product('G01', 'Green Widget', 24.95),
            'B01' => new Product('B01', 'Blue Widget', 7.95),
        ];
    }

    private function createBasket(): Basket
    {
        $basket = new Basket($this->getCatalogue(), new StandardDeliveryRule());
        $basket->addDiscountRule(new BuyRedWidgetGetOtherHalfDiscountRule());
        return $basket;
    }

    public function test_b01_and_g01_total()
    {
        $basket = $this->createBasket();
        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(37.85, $basket->total());
    }

    public function test_r01_and_r01_total()
    {
        $basket = $this->createBasket();
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(54.37, $basket->total());
    }

    public function test_r01_and_g01_total()
    {
        $basket = $this->createBasket();
        $basket->add('R01');
        $basket->add('G01');
        $this->assertEquals(60.85, $basket->total());
    }

    public function test_b01_b01_r01_r01_r01_total()
    {
        $basket = $this->createBasket();
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(98.27, $basket->total());
    }
}
