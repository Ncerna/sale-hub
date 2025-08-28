<?php
namespace Application\Service;

use Application\UseCase\CreateProductUseCase;
use Application\UseCase\UpdateStockUseCase;

class ProductCoordinatorService
{
    private CreateProductUseCase $createUseCase;
    private UpdateStockUseCase $updateStockUseCase;
    

    public function __construct(
        CreateProductUseCase $createUseCase,
        UpdateStockUseCase $updateStockUseCase,
      
    ) {
        $this->createUseCase = $createUseCase;
        $this->updateStockUseCase = $updateStockUseCase;
    
    }

    public function createProduct($command)
    {
        $this->createUseCase->execute($command);
    }

    public function updateStock($id, $qty)
    {
        $this->updateStockUseCase->execute($id, $qty);
    }

    public function listProducts($page, $size, $search)
    {
       // return $this->productService->listProducts($page, $size, $search);
    }
}
