<?php
namespace App\Application\UseCase;

use App\Domain\IRepository\IProductRepository;

class DeleteProductUseCase
{
    private IProductRepository $repository;

    public function __construct(IProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
