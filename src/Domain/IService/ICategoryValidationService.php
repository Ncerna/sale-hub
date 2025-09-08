<?php
namespace Domain\IService;

use Domain\Entity\Category;

interface ICategoryValidationService
{
    public function validate(Category $category): bool;
}