<?php
namespace Domain\IRepository;

use Domain\Entity\Product1;

interface IProductRepository1
{
    public function findById(string $id): ?Product1;

    public function findByCode(string $code): ?Product1;

    public function save(Product1 $product): void;

    public function delete(string $id): void;
}
