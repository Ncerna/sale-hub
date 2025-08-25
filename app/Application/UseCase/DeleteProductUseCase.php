<?php
namespace App\Application\UseCase;

use App\Domain\IRepository\IProductRepository;

class DeleteProductUseCase
{
    private IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(int $id): bool
    {
        return $this->productRepository->delete($id);
    }
}
