<?php
namespace Infrastructure\Framework\Adapters;

use Domain\Entity\Product;
use Application\DTOs\ProductDTO;

class ProductAdapter1
{
   /* public static function toDTO(Product $product): ProductDTO
    {
        return new ProductDTO(
            $product->getId(),
            $product->getName(),
            $product->getCode(),
            $product->getUnitPrice()->getPriceWithIGV(),
            $product->getStock()
        );
    }

    public static function toDomainEntity(ProductDTO $DTOs): Product
    {
        // Si necesitas convertir en sentido inverso
        // construir entidad Product usando DTOs y value objects
    }*/
}
