<?php
class SellProductUseCase
{
    private ProductRepositoryInterface $productRepository;
    private InventoryService $inventoryService;

    public function __construct(
        ProductRepositoryInterface $productRepository, 
        InventoryService $inventoryService
    ) {
        $this->productRepository = $productRepository;
        $this->inventoryService = $inventoryService;
    }

    public function execute(string $productId, int $quantitySold): void
    {
        $product = $this->productRepository->findById($productId);
        if (!$product) {
            throw new \Exception("Producto no encontrado");
        }

        // Validar stock suficiente
        if ($product->getStock() < $quantitySold) {
            throw new \Exception("Stock insuficiente");
        }

        // Actualizar stock usando servicio especializado
        $this->inventoryService->updateStock($productId, -$quantitySold); // resta cantidad
    }
}
