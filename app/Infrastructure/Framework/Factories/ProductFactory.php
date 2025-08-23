<?php
// Application/Factories/ProductFactory.php

namespace Application\Factories;

use Domain\Entities\Product;
use Domain\ValueObjects\Price;

class ProductFactory
{
    public static function createFromArray(array $data): Product
    {
        return new Product(
            $data['id'] ?? uniqid(),
            $data['name'],
            new Price($data['price']),
            $data['stock'] ?? 0
            // otros atributos y value objects...
        );
    }
}
