<?php declare(strict_types=1);

namespace ShoppingBasket\Money;

use ShoppingBasket\Basket\Basket;

final class CalculateTotalCost
{
    public const DISCOUNT = 0.1;

    public function __invoke(Basket $basket): Money
    {
        $cost = $basket->calculateItemsCost();
        return $cost->multiply(1 - self::DISCOUNT);
    }
}