<?php
namespace Infrastructure\ServiceImplementations;

use Application\Contracts\ProductServiceInterface;
use Domain\IRepository\IProductRepository;
use Application\Factories\ProductFactory;
//S una forma
//class ProductService implements ProductServiceInterface
{
/*    private IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function registerProduct(array $data): void
    {
        // Crear entidad producto usando fábrica
        $product = ProductFactory::createFromArray($data);
        // Guardar usando repositorio del dominio
        $this->productRepository->save($product);
    }

    public function updateProduct(string $id, array $data): void
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            throw new \InvalidArgumentException("Producto no encontrado");
        }
        // Actualizar atributos según datos recibidos
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

    public function getProduct(string $id)
    {
        return $this->productRepository->findById($id);
    }

    public function listAll(int $page, int $size, ?string $search = null): array
    {
        return $this->productRepository->list($page, $size, $search);
    }*/
}
