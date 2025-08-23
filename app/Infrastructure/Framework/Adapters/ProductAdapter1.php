<?php
namespace Infrastructure\Framework\Adapters;

use Domain\Entity\Product;
use Application\DTO\ProductDTO;

class ProductAdapter
{
    public static function toDTO(Product $product): ProductDTO
    {
        return new ProductDTO(
            $product->getId(),
            $product->getName(),
            $product->getCode(),
            $product->getUnitPrice()->getPriceWithIGV(),
            $product->getStock()
        );
    }

    public static function toDomainEntity(ProductDTO $dto): Product
    {
        // Si necesitas convertir en sentido inverso
        // construir entidad Product usando DTO y value objects
    }
}
