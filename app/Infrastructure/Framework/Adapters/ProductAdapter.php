<?php
namespace Infrastructure\Framework\Adapters;

use Domain\Entity\Product;

class ProductAdapter
{
    public static function toArray(Product $product): array
    {
        return [
            'id' => $product->getId(),
            'name' => $product->getName(),
            // Otros campos
        ];
    }
}
