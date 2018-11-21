<?php declare(strict_types=1);

namespace ShoppingBasketTest;

use PHPUnit\Framework\TestCase;
use ShoppingBasket\Basket\Basket;
use ShoppingBasket\Basket\BasketItem;
use ShoppingBasket\Money\Money;

class BasketTest extends TestCase
{
    /** @test */
    function basket_cannot_be_empty()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Empty basket');

        new Basket(...[]);
    }

    /** @test */
    function all_items_in_a_basket_need_to_use_the_same_currency()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Inconsistent currency');

        new Basket(...[
            new BasketItem('orange juice', new Money(10, 'GBP')),
            new BasketItem('something else', new Money(20, 'USD')),
        ]);
    }

    /** @test */
    function cost_of_items_in_a_basket_can_be_added_up()
    {
        $basket = new Basket(...[
            new BasketItem('orange juice', new Money(10, 'GBP')),
            new BasketItem('something else', new Money(20, 'GBP')),
        ]);

        self::assertSame((float) 10 + 20, $basket->calculateItemsCost()->getAmount());
    }
}