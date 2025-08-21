<?php
namespace Domain\IService;

use Domain\Entity\Product1;

interface IProductDomainService1
{
    public function canApplyDiscount(Product1 $product, float $discountPercentage): bool;
    
    public function calculateTotalCost(Product1 $product): float;
}
