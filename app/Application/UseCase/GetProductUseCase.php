<?php
namespace Application\UseCase;

use Domain\IRepository\IProductRepository;
use Domain\Entity\Product;

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

