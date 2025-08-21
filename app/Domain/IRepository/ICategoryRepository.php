<?php
namespace App\Domain\IRepository;

use App\Domain\Entity\Category;

interface ICategoryRepository
{
    public function save(Category $category): void;
    public function findById(int $id): ?Category;
    public function findAll(): array;
     public function findAllPaginated(int $page, int $size, ?string $search): array;
    public function delete(int $id): void;
}
