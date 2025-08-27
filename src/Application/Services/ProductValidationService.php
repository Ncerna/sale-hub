<?php

namespace Application\Services;

use Domain\IService\IProductValidationService;
use Domain\Entity\Product;

class ProductValidationService implements IProductValidationService
{
    public function validate($product): bool
    {
        if (!$product instanceof Product) {
            throw new \InvalidArgumentException("El objeto no es una instancia válida de Product.");
        }

        // Ejemplo de validación básica:
        if (empty($product->getName())) {
            throw new \Exception("El nombre del producto es obligatorio.");
        }

        if (empty($product->getCode())) {
            throw new \Exception("El código del producto es obligatorio.");
        }

        // Más validaciones que necesites...

        return true;
    }
}
