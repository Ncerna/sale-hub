<?php
namespace App\Application\UseCase;

use App\Domain\Entity\Product;
use App\Domain\IRepository\IProductRepository;

class UpdateProductUseCase
{
    private IProductRepository $repository;

    public function __construct(IProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id, string $name, float $price, int $stock): ?Product
    {
        $product = $this->repository->findById($id);
        if (!$product) {
            return null;
        }
        $updated = new Product($id, $name, $price, $stock);
        return $this->repository->update($updated);
    }
}
