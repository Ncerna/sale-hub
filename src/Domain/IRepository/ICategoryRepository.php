<?php
namespace Domain\IRepository;

use Domain\Entity\Category;

interface ICategoryRepository
{
    //public function save(Category $category): void;
    public function save(Category $category): ?Category;
    public function findById(int $id): ?Category;
    public function findAll(): array;

    public function delete(int $id): void;
}
