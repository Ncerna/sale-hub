<?php
namespace Application\Command;

use Application\DTO\ProductDTO;

class CreateProductCommand
{
    public ProductDTO $productDTO;

    public function __construct(ProductDTO $productDTO)
    {
        $this->productDTO = $productDTO;
    }
}
