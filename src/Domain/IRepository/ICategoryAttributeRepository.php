<?php
namespace Domain\IRepository;

use Domain\Entity\CategoryAttribute;

interface ICategoryAttributeRepository
{
    public function save(CategoryAttribute $attribute): void;
    public function findById(int $id): ?CategoryAttribute;
    public function findByCategoryId(int $categoryId): array;
    //public function delete(int $id): void;
    public function delete(CategoryAttribute $attribute): void;
    
}
