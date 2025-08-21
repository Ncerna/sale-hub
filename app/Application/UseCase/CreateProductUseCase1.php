<?php
namespace Application\UseCase;

use Domain\IRepository\IProductRepository1;
use Domain\Entity\Product1;
use Domain\ValueObject\Price;
use Domain\ValueObject\IGVRate;
use Domain\ValueObject\IGVAffectationCode;
use Application\Command\CreateProductCommand1;
use Application\DTO\ProductDTO1;

class CreateProductUseCase
{
    private IProductRepository1 $productRepository;

    public function __construct(IProductRepository1 $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(CreateProductCommand1 $command): ProductDTO1
    {
        $price = new Price($command->unit_price, new IGVRate($command->igv_rate));
        $igvCode = new IGVAffectationCode($command->igv_affectation_code);

        $product = new Product1(
            id: uniqid(), // Generar un id único, ejemplo simple
            name: $command->name,
            code: $command->code,
            unit_price: $price,
            igv_rate: new IGVRate($command->igv_rate),
            igv_affectation_code: $igvCode,
            stock: $command->stock,
            minimum_stock: $command->minimum_stock
        );

        $this->productRepository->save($product);

        return new ProductDTO1([
            'id' => $product->getId(),
            'name' => $product->getName(),
            'code' => $product->getCode(),
            'unit_price' => $product->getUnitPrice()->getBasePrice(),
            'igv_rate' => $product->getIgvRate()->getRate(),
            'igv_affectation_code' => $product->getIgvAffectationCode()->getCode(),
            'stock' => $product->getStock(),
            'minimum_stock' => $product->getMinimumStock(),
        ]);
    }
}
