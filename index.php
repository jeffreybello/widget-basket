<?php

require __DIR__.'/vendor/autoload.php';

use App\Rules\Discount\BuyRedWidgetGetOtherHalfDiscountRule;
use App\Services\Basket;
use App\Rules\Delivery\StandardDeliveryRule;

$catalogue = require __DIR__.'/data/catalogue.php';

// B01, G01
$basket = new Basket($catalogue, new StandardDeliveryRule());
$basket->addDiscountRule(new BuyRedWidgetGetOtherHalfDiscountRule());
$basket->add('B01');
$basket->add('G01');
echo "B01, G01: Total: $" . $basket->total();
echo "<br>";

// R01, R01
$basket = new Basket($catalogue, new StandardDeliveryRule());
$basket->addDiscountRule(new BuyRedWidgetGetOtherHalfDiscountRule());
$basket->add('R01');
$basket->add('R01');
echo "R01, R01: Total: $" . $basket->total();
echo "<br>";

// R01, G01
$basket = new Basket($catalogue, new StandardDeliveryRule());
$basket->addDiscountRule(new BuyRedWidgetGetOtherHalfDiscountRule());
$basket->add('R01');
$basket->add('G01');
echo "R01, G01: Total: $" . $basket->total();
echo "<br>";

// B01, B01, R01, R01, R01
$basket = new Basket($catalogue, new StandardDeliveryRule());
$basket->addDiscountRule(new BuyRedWidgetGetOtherHalfDiscountRule());
$basket->add('B01');
$basket->add('B01');
$basket->add('R01');
$basket->add('R01');
$basket->add('R01');
echo "B01, B01, R01, R01, R01: Total: $" . $basket->total();
