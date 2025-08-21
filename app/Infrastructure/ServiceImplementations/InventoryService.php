<?php
namespace Infrastructure\ServiceImplementations;

use Domain\IRepository\IProductRepository1;

class InventoryService
{
    private IProductRepository1 $productRepository;

    public function __construct(IProductRepository1 $productRepository)
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
