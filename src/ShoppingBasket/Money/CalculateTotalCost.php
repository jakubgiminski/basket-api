<?php declare(strict_types=1);

namespace ShoppingBasket\Money;

use ShoppingBasket\Basket\Basket;
use ShoppingBasket\Money\Money;

final class CalculateTotalCost
{
    private const DISCOUNT = 0.1;

    public function __invoke(Basket $basket): Money
    {
        $cost = $basket->calculateItemsCost();
        return $cost->multiply(1 - self::DISCOUNT);
    }
}