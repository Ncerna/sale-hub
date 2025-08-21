<?php
namespace Infrastructure\Framework\Adapters;

use Domain\Entity\Product1;
use Application\DTO\ProductDTO1;

class ProductAdapter
{
    public static function toDTO(Product1 $product): ProductDTO1
    {
        return new ProductDTO1(
            $product->getId(),
            $product->getName(),
            $product->getCode(),
            $product->getUnitPrice()->getPriceWithIGV(),
            $product->getStock()
        );
    }

    public static function toDomainEntity(ProductDTO1 $dto): Product1
    {
        // Si necesitas convertir en sentido inverso
        // construir entidad Product usando DTO y value objects
    }
}
