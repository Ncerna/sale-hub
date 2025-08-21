<?php
// Archivo: Application/UseCase/UpdateStockUseCase.php
namespace Application\UseCase;

use Infrastructure\ServiceImplementations\InventoryService;

class UpdateStockUseCase
{
    private InventoryService $inventoryService;

    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    public function execute(string $productId, int $quantity): bool
    {
        return $this->inventoryService->updateStock($productId, $quantity);
    }
}
