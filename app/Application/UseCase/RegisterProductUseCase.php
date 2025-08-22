<?php
namespace Application\UseCase;
use App\Domain\IRepository\IProductRepository;

use Domain\IService\IProductValidationService;
use Domain\Entity\Product;

class RegisterProductUseCase
{
    private IProductRepository $productRepository;
    private IProductValidationService $validationService;

    public function __construct(IProductRepository $productRepository, IProductValidationService $validationService)
    {
        $this->productRepository = $productRepository;
        $this->validationService = $validationService;
    }

    public function execute(Product $product): void
    {
        if (!$this->validationService->validate($product)) {
            throw new \Exception("Product validation failed.");
        }

        $this->productRepository->save($product);
    }
}
/*
namespace Application\UseCase;
use Application\DTO\ProductDTO;
use Domain\Entity\Product;
use Domain\IRepository\IProductRepository;
use Domain\ValueObject\Price;
use Domain\ValueObject\IGVRate;
use Domain\ValueObject\IGVAffectationCode;
use Domain\ValueObject\ProductAttribute;

class RegisterProductUseCase {
    private IProductRepository $repo;

    public function __construct(IProductRepository $repo) { $this->repo = $repo; }

    public function execute(ProductDTO $dto): void {
        $attrs = array_map(
            fn($a) => new ProductAttribute($a['attribute_id'], $a['value']),
            $dto->attributes
        );
        $product = new Product(
            $dto->name,
            $dto->code,
            new Price($dto->unit_price),
            new IGVRate($dto->igv_rate),
            new IGVAffectationCode($dto->igv_affectation_code),
            $dto->stock,
            $dto->minimum_stock,
            $dto->status,
            $attrs
        );
        $this->repo->save($product);
    }
}
*/