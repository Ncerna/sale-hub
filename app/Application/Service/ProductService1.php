<?php
namespace Application\Service;

use Domain\IRepository\IProductRepository1;
use Domain\Entity\Product1;
class ProductService
{
    private IProductRepository1 $productRepository;

    public function __construct(IProductRepository1 $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function listProducts(int $page, int $size, ?string $search = null): array
    {
        return $this->productRepository->findAll($page, $size, $search);
    }
    public function getProductById(string $id): ?Product1
    {
        return $this->productRepository->findById($id);
    }

    public function createProduct(Product1 $product): void
    {
        $this->productRepository->save($product);
    }

    public function updateProduct(Product1 $product): void
    {
        $this->productRepository->save($product);
    }

    public function deleteProduct(Product1 $product): void
    {
        $this->productRepository->delete($product);
    }

    // Otros métodos de aplicación si es necesario
}
