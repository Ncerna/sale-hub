<?php
namespace Application\Contracts;
use Illuminate\Http\Request;
use Domain\Entity\Category;

interface CategoryServiceInterface {
    public function registeCategory(array $data): array;
    public function updateCategory(array $data , int $id): array;
    public function getCategory(int $id): array|Category;
    public function deleteCategory(int $id): array;

}