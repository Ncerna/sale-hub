<?php
namespace App\Application\UseCase;

use App\Domain\IRepository\IProductRepository;
use App\Domain\Entity\Product;

class GetProductUseCase
{
    private IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(int $id): ?Product
    {
        return $this->productRepository->findById($id);
    }
}

