<?php
namespace App\Domain\IService;

use App\Domain\Entity\Product;

interface IProductValidationService
{
    public function validate(Product $product): bool;
}
