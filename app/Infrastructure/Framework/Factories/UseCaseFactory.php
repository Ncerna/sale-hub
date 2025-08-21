<?php
namespace Infrastructure\Framework\Factories;

use Application\UseCase\CreateProductUseCase;
use Infrastructure\Persistence\EloquentProductRepository;

class UseCaseFactory
{
    public static function createCreateProductUseCase(): CreateProductUseCase
    {
        $repository = new EloquentProductRepository();
        return new CreateProductUseCase($repository);
    }

    // Puedes crear métodos para otros casos de uso aquí
}
