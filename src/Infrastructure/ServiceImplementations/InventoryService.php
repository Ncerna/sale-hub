<?php
namespace Infrastructure\ServiceImplementations;

use Domain\IRepository\IProductRepository;

class InventoryService
{
    private IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function updateStock(string $productId, int $quantity): bool
    {
        $product = $this->productRepository->findById($productId);
        if (!$product) {
            return false;
        }
        $product->updateStock($quantity);
        $this->productRepository->save($product);
        return true;
    }
}
