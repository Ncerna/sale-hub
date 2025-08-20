<?php
namespace App\Application\UseCase;

use App\Domain\IRepository\IProductRepository;

class ListProductsUseCase
{
    private IProductRepository $repository;

    public function __construct(IProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): array
    {
        return $this->repository->findAll();
    }
}
