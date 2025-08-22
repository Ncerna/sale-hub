<?php
namespace Domain\IService;

use Domain\Entity\ProductAttribute;

interface IProductAttributeService
{
    /**
     * Valida un solo atributo del producto.
     */
    public function validate(ProductAttribute $attribute): bool;

    /**
     * Valida una lista de atributos del producto.
     * @param ProductAttribute[] $attributes
     */
    public function validateAll(array $attributes): bool;
}
