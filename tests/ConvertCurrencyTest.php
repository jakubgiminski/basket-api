<?php declare(strict_types=1);

namespace ShoppingBasketTest;

use ShoppingBasket\Money\ConvertCurrency;
use PHPUnit\Framework\TestCase;
use ShoppingBasket\Money\Money;

class ConvertCurrencyTest extends TestCase
{
    /** @test */
    function can_convert_GBP_to_USD()
    {
        self::assertEquals(
            new Money(100 * ConvertCurrency::CONVERSION_RATE, 'USD'),
            (new ConvertCurrency)(new Money(100, 'GBP'), 'USD')
        );
    }

    /** @test */
    function cannot_convert_USD_to_GBP()
    {
        $this->expectException(\OutOfBoundsException::class);
        (new ConvertCurrency)(new Money(123, 'USD'), 'GBP');
    }
}