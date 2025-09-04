<?php
namespace Application\UseCase\Product;

use Domain\Entity\Product;
use Domain\IRepository\IProductRepository;
use Domain\IService\IProductValidationService;


class CreateProductUseCase
{
    private IProductRepository $productRepository;
    private IProductValidationService $validationService;

    public function __construct(IProductRepository $productRepository, IProductValidationService $validationService)
    {
        $this->productRepository = $productRepository;
        $this->validationService = $validationService;
    }

    public function execute(Product $product): Product
    {
        if (!$this->validationService->validate($product)) {
            throw new \Exception("Product validation failed");
        }
        
        return $this->productRepository->save($product);
    }
}
