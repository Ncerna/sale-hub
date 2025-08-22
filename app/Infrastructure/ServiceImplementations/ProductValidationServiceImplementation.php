<?php
namespace Infrastructure\ServiceImplementations;

use Domain\Entity\Product;
use Domain\IService\IProductValidationService;
use Domain\IService\IProductAttributeService;

class ProductValidationServiceImplementation implements IProductValidationService
{
    private IProductAttributeService $attributeService;

    public function __construct(IProductAttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }

    public function validate(Product $product): bool
    {
        if (empty($product->getName())) {
            return false;
        }

        if ($product->getStock() < 0) {
            return false;
        }

        // Delegar validación a los atributos
        if (!$this->attributeService->validateAll($product->getAttributes())) {
            return false;
        }

        return true;
    }
}
