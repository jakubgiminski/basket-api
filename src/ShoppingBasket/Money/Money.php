<?php declare(strict_types=1);

namespace ShoppingBasket\Money;

class Money
{
    private $amount;

    private $currency;

    public function __construct(float $amount, string $currency)
    {
        self::validateCurrency($currency);

        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function multiply(float $multiplier): self
    {
        $amount = $this->amount * $multiplier;
        return new self(round($amount, 2), $this->currency);
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    private static function validateCurrency(string $currency): void
    {
        if ($currency !== 'GBP' && $currency !== 'USD') {
            throw new \InvalidArgumentException("Unsupported currency: $currency");
        }
    }
}