<?php declare(strict_types=1);

namespace App\ValueObject;

use App\ValueObject\BasketItem;
use App\ValueObject\Money;

class Basket
{
    private $items;

    public function __construct(BasketItem ...$items)
    {
        self::ensureNotEmpty(...$items);
        self::ensureConsistentCurrency(...$items);
        $this->items = $items;
    }

    public function calculateItemsCost(): Money
    {
        $cost = 0;
        foreach ($this->items as $item) {
            $cost += $item->getCost()->getAmount();
        }
        return new Money($cost, $this->getCurrency());
    }

    public function getItems(): array
    {
        return $this->items;
    }

    private function getCurrency(): string
    {
        return reset($this->items)->getCost()->getCurrency();
    }

    private static function ensureNotEmpty(BasketItem ...$items): void
    {
        if (empty($items)) {
            throw new \InvalidArgumentException("Empty basket");
        }
    }

    private static function ensureConsistentCurrency(BasketItem ...$items): void
    {
        $currency = reset($items)->getCost()->getCurrency();
        foreach ($items as $item) {
            if ($item->getCost()->getCurrency() !== $currency) {
                throw new \RuntimeException("Inconsistent currency");
            }
        }
    }
}

