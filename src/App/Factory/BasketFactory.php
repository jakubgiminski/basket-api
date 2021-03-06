<?php declare(strict_types=1);

namespace App\Factory;

use ShoppingBasket\Basket\Basket;
use ShoppingBasket\Basket\BasketItem;
use ShoppingBasket\Money\Money;
use Symfony\Component\HttpFoundation\Request;

class BasketFactory
{
    public function createFromRequest(Request $request): Basket
    {
        $requestItems = json_decode($request->get('items'), true);
        $items = [];

        foreach ($requestItems as $requestItem) {
            $cost = new Money($requestItem['cost']['amount'], $requestItem['cost']['currency']);
            $items[] = new BasketItem($requestItem['description'], $cost);
        }

        return new Basket(...$items);
    }
}
