<?php
namespace Domain\IService;

use Domain\Entity\Product;

interface IProductValidationService
{
    public function validate(Product $product): bool;
}
