<?php declare(strict_types=1);

namespace ShoppingBasketTest;

use PHPUnit\Framework\TestCase;
use ShoppingBasket\Basket\Basket;
use ShoppingBasket\Basket\BasketItem;
use ShoppingBasket\Money\CalculateTotalCost;
use ShoppingBasket\Money\Money;

class CalculateTotalCostTest extends TestCase
{
    /** @test */
    function calculate_total_cost_of_one_item()
    {
        $basket = new Basket(...[
            new BasketItem('orange juice', new Money(1.4, 'GBP'))
        ]);

        $totalCost = (new CalculateTotalCost())($basket);

        self::assertEquals(
            new Money(1.4 * (1 - CalculateTotalCost::DISCOUNT), 'GBP'),
            $totalCost
        );
    }

    /** @test */
    function calculate_total_cost_of_three_items()
    {
        $basket = new Basket(...[
            new BasketItem('orange juice', new Money(10, 'GBP')),
            new BasketItem('orange juice', new Money(20, 'GBP')),
            new BasketItem('orange juice', new Money(20, 'GBP')),
        ]);

        $totalCost = (new CalculateTotalCost())($basket);

        self::assertEquals(
            new Money(50 * (1 - CalculateTotalCost::DISCOUNT), 'GBP'),
            $totalCost
        );
    }
}