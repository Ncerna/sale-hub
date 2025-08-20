<?php
namespace App\Application\UseCase;

use App\Domain\Entity\Product;
use App\Domain\IRepository\IProductRepository;

class CreateProductUseCase
{
    private IProductRepository $repository;

    public function __construct(IProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $name, float $price, int $stock): Product
    {
        $product = new Product(null, $name, $price, $stock);
        return $this->repository->save($product);
    }
}
