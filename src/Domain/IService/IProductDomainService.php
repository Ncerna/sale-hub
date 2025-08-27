<?php
namespace Domain\IService;
use Domain\Entity\Product;
interface IProductDomainService
{
    public function canApplyDiscount(Product $product, float $discountPercentage): bool;
    
    public function calculateTotalCost(Product $product): float;
}
