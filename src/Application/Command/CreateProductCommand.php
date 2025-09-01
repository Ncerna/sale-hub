<?php
namespace Application\Command;

use Application\DTOs\ProductDTO;

class CreateProductCommand
{
    public ProductDTO $productDTO;

    public function __construct(ProductDTO $productDTO)
    {
        $this->productDTO = $productDTO;
    }
}
