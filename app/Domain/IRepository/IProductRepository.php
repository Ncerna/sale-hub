<?php
namespace Domain\IRepository;

use Domain\Entity\Product;
interface IProductRepository
{
    public function save(Product $product): Product;
    public function findById(int $id): ?Product;
    public function findAll(): array;
    public function delete(int $id): bool;
    public function findByCode(string $code): ?Product;

 
/**
     * @param int $page
     * @param int $size
     * @param string|null $search
     * @return Product[]
     */
    public function list(int $page, int $size, ?string $search = null): array;

}
