<?php
namespace Infrastructure\ServiceImplementations;

use Domain\IService\IProductDomainService1;
use Domain\Entity\Product1;
use Infrastructure\Framework\Controller\ProductController1;

class ProductDomainService1 implements IProductDomainService1
{
    public function canApplyDiscount(Product1 $product, float $discountPercentage): bool
    {
        // Ejemplo de regla: no permitir más del 50% de descuento
        if ($discountPercentage < 0 || $discountPercentage > 50) {
            return false;
        }

        // No aplicar descuento si el producto ya está en promoción (flag o precio especial)
        if ($product->getOfferPrice() !== null && $product->getOfferPrice() < $product->getUnitPrice()->getBasePrice()) {
            return false;
        }

        return true;
    }

    public function calculateTotalCost(Product1 $product): float
    {
        // Ejemplo: total = stock * unit cost
        return $product->getStock() * $product->getUnitPrice();
    }
}
