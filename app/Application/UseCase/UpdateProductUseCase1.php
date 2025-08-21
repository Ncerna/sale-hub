<?php
namespace Application\UseCase;

use Domain\IRepository\IProductRepository1;
use Domain\ValueObject\Price;
use Domain\ValueObject\IGVRate;
use Domain\ValueObject\IGVAffectationCode;
use Application\Command\UpdateProductCommand1;
use Application\DTO\ProductDTO1;

class UpdateProductUseCase
{
    private IProductRepository1 $productRepository;

    public function __construct(IProductRepository1 $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(UpdateProductCommand1 $command): ProductDTO1
    {
        $product = $this->productRepository->findById($command->id);

        if (!$product) {
            throw new \InvalidArgumentException("Producto no encontrado.");
        }

        // Actualizar atributos con Value Objects
        $product->setName($command->name);
        $product->setCode($command->code);
        $product->setUnitPrice(new Price($command->unit_price, new IGVRate($command->igv_rate)));
        $product->setIgvRate(new IGVRate($command->igv_rate));
        $product->setIgvAffectationCode(new IGVAffectationCode($command->igv_affectation_code));
        $product->setStock($command->stock);
        $product->setMinimumStock($command->minimum_stock);
        $product->setUpdatedAt(new \DateTime());

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
