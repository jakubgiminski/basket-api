# Basket API

An API that allows you to calculate basket cost based on the items in it an a 10% discount. It also converts the currency from GBP to USD.

## Domain and the app
The domain model of the Shopping Basket is located [here](https://github.com/jakubgiminski/basket-api/tree/master/src/ShoppingBasket) and 
the symfony app (controller, route, and a factory) is [here](https://github.com/jakubgiminski/basket-api/tree/master/src/App)

## Installation 
Required php version is 7.2. Use composer for dependencies management.
```
composer install
```

## Tests
### Execute the test suite
```vendor/bin/phpunit tests --testdox --color```
### Output
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
Request {
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
Response {
    body = "total_basket_cost": {
        "amount",
        "currency"
    }
}
```

## Run the symfony server
```
php bin/console server:start
```
