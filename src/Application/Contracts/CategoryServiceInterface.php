<?php
namespace Application\Contracts;
use Illuminate\Http\Request;
use Domain\Entity\User;

interface CategoryServiceInterface {
    public function registeCategory(array $data): array;
    public function updateCategory(array $data , int $id): array;

}