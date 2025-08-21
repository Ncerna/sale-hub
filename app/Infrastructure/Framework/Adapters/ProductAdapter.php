<?php
namespace Infrastructure\Framework\Adapters;

use Domain\Entity\Product1;

class ProductAdapter
{
    public static function toArray(Product1 $product): array
    {
        return [
            'id' => $product->getId(),
            'name' => $product->getName(),
            // Otros campos
        ];
    }
}
