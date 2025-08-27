<?php
namespace Infrastructure\Framework\Factories;

use Infrastructure\Persistence\EloquentProductRepository;
use Infrastructure\ServiceImplementations\ProductValidationServiceImplementation;
use Application\UseCase\CreateProductUseCase;
use Application\UseCase\UpdateProductUseCase;
use Application\UseCase\DeleteProductUseCase;
use Application\UseCase\GetProductUseCase;
use Application\UseCase\ListProductUseCase;
use Application\Service\ProductApplicationService;

class ServiceFactory
{
    public static function createProductApplicationService(): ProductApplicationService
    {
        $repository = new EloquentProductRepository();
        $validationService = new ProductValidationServiceImplementation();

        $registerUseCase = new CreateProductUseCase($repository, $validationService);
        $updateUseCase = new UpdateProductUseCase($repository, $validationService);
        $deleteUseCase = new DeleteProductUseCase($repository);
        $getUseCase = new GetProductUseCase($repository);
        $listUseCase = new ListProductUseCase($repository);

        return new ProductApplicationService(
            $registerUseCase,
            $updateUseCase,
            $deleteUseCase,
            $getUseCase,
            $listUseCase
        );
    }
}
