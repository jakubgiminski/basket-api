# Basket API

An API that allows you to calculate basket cost based on the items in it an a 10% discount.

## API documentation
```js
{
    url = "/calculate-basket-cost",
    method = "POST"
    body = [
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
