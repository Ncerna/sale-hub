<?php
namespace Domain\IRepository;

use Domain\Entity\Product1;

interface IProductRepository1
{
    public function findById(string $id): ?Product1;

    public function findByCode(string $code): ?Product1;
    public function findAll(int $page, int $size, ?string $search = null): array;

    public function save(Product1 $product): void;
    public function delete(Product1 $product): void;
}
