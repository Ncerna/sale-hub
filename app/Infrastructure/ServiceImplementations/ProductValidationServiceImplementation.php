<?php
namespace Infrastructure\ServiceImplementations;

use Domain\IService\IProductValidationService;
use Domain\Entity\Product;

class ProductValidationServiceImplementation implements IProductValidationService
{
    public function validate(Product $product): bool
    {
        if (empty($product->getName())) {
            return false;
        }
        if ($product->getStock() < 0) {
            return false;
        }
        // Aquí podrías validar atributos si tienes servicio para eso.
        return true;
    }
}
