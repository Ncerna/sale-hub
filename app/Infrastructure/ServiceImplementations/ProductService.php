<?php

namespace Infrastructure\ServiceImplementations;

use Application\Contracts\ProductServiceInterface;
use App\Domain\IRepository\IProductRepository;
use Application\Factories\ProductFactory;
use App\Domain\Entities\Product;

class ProductService implements ProductServiceInterface
{
    private IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function registerProduct(array $data): void
    {
        // Crear entidad producto con fábrica desde datos recibidos
        $product = ProductFactory::createFromArray($data);
        $this->productRepository->save($product);
    }

    public function updateProduct(string $id, array $data): void
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            throw new \InvalidArgumentException("Producto no encontrado");
        }
        // Actualizar atributos - ejemplo simple, ideal usar setters
        if (isset($data['name'])) {
            $product->setName($data['name']);
        }
        if (isset($data['price'])) {
            $product->setPrice($data['price']);
        }
        $this->productRepository->save($product);
    }

    public function deleteProduct(string $id): void
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            throw new \InvalidArgumentException("Producto no encontrado");
        }
        $this->productRepository->delete($product);
    }

    public function getProduct(string $id): ?Product
    {
        return $this->productRepository->findById($id);
    }
}


