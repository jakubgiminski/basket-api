# Basket API

An API that allows you to calculate basket cost based on the items in it an a 10% discount. It also converts the currency from GBP to USD.

### Tests

```
ShoppingBasketTest\Basket
 ✔ Basket cannot be empty
 ✔ All items in a basket need to use the same currency
 ✔ Cost of items in a basket can be added up

ShoppingBasketTest\CalculateTotalCost
 ✔ Can calculate total cost of one item
 ✔ Can calculate total cost of three items

ShoppingBasketTest\ConvertCurrency
 ✔ Can convert GBP to USD
 ✔ Cannot convert USD to GBP
```

## API documentation
```js
{
    url = "/calculate-basket-cost",
    method = "POST"
    body = {
        "items": [
            {
                "description",
                "cost": {
                    "amount",
                    "currency"
                }
            },
            ...
        ]
    }
}
```

## Installation 
Make sure you have php 7.2. Then, run composer to install php dependencies.
```
composer install
```
## Run Symfony server
```
php bin/console server:start
```
