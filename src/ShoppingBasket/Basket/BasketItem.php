<?php declare(strict_types=1);

namespace ShoppingBasket\Basket;

use ShoppingBasket\Money\Money;

class BasketItem
{
    private $description;

    private $cost;

    public function __construct(string $description, Money $cost)
    {
        $this->description = $description;
        $this->cost = $cost;
    }

    public function getCost(): Money
    {
        return $this->cost;
    }
}