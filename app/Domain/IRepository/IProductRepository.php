<?php
namespace App\Domain\IRepository;

use App\Domain\Entity\Product;

interface IProductRepository
{
    public function save(Product $product): Product;
    public function findById(int $id): ?Product;
    public function findAll(): array;
    public function delete(int $id): bool;
    public function update(Product $product): Product;


}
