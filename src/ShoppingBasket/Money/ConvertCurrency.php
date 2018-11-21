<?php declare(strict_types=1);

namespace ShoppingBasket\Money;

final class ConvertCurrency
{
    public const CONVERSION_RATE = 1.28;

    public function __invoke(Money $money, string $targetCurrency): Money
    {
        $initialCurrency = $money->getCurrency();

        if ($initialCurrency !== 'GBP' || $targetCurrency !== 'USD') {
            throw new \OutOfBoundsException("Unsupported conversion type: $initialCurrency -> $targetCurrency");
        }

        $amount = $money->getAmount() * self::CONVERSION_RATE;

        return new Money(round($amount, 2), 'USD');
    }
}