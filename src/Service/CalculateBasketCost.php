<?php declare(strict_types=1);

namespace App\Service;

use App\ValueObject\Basket;
use App\ValueObject\Money;

final class CalculateBasketCost
{
    private const DISCOUNT = 0.1;

    public function __invoke(Basket $basket): Money
    {
        $cost = $basket->calculateItemsCost();
        return $cost->multiply(1 - self::DISCOUNT);
    }
}