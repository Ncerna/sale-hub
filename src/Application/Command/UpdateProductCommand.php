<?php
namespace Application\Command;

use Application\DTOs\ProductDTO;

class UpdateProductCommand
{
    public int $id;
    public ProductDTO $productDTO;

    public function __construct(int $id, ProductDTO $productDTO)
    {
        $this->id = $id;
        $this->productDTO = $productDTO;
    }
}
