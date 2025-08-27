<?php
namespace Application\Contracts;

use Domain\Entity\Product;

interface ProductServiceInterface
{
    public function registerProduct(array $data): Product;

    public function updateProduct(int $id, array $data): Product;

    public function deleteProduct(int $id): void;

    public function getProduct(int $id): ?Product;

    public function listAll(int $page, int $size, ?string $search = null): array;
}



