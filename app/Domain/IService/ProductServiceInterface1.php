<?php
namespace Domain\IService;
use Domain\Entity\Product1;
interface ProductServiceInterface1 {
    public function createProduct(Product1 $product): void;
    public function updateProduct(Product1 $product): void;
    public function getProducts(int $page, int $size, ?string $search = null): array;
    public function deleteProduct(string $productId): void;
}
