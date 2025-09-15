<?php
namespace Infrastructure\ServiceImplementations;

use Domain\Entity\Category;
use Domain\IService\ICategoryValidationService;


class CategoryValidationService implements ICategoryValidationService
{
 

    public function __construct()
    {
        
    }

    public function validate(Category $category): bool
    {
        if (empty($category->getName())) {
            return false;
        }

        return true;
    }
}