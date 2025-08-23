<?php
namespace Application\UseCase;

use Domain\IRepository\IProductRepository;
use Domain\IService\IProductValidationService;
use Domain\Entity\Product;

class UpdateProductUseCase
{
    private IProductRepository $productRepository;
    private IProductValidationService $validationService;

    public function __construct(IProductRepository $productRepository, IProductValidationService $validationService)
    {
        $this->productRepository = $productRepository;
        $this->validationService = $validationService;
    }

    public function execute(Product $product): void
    {
        if (!$this->validationService->validate($product)) {
            throw new \Exception("Product validation failed.");
        }

        $this->productRepository->update($product);
    }
}
