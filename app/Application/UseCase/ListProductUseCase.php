<?php
namespace App\Application\UseCase;

use Domain\IRepository\IProductRepository;

class ListProductUseCase
{
    private IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(int $page, int $size, ?string $search = null): array
    {
        return $this->productRepository->list($page, $size, $search);
    }
}
