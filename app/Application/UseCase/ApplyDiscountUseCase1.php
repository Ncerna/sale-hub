<?php
namespace Application\UseCase;

use Domain\IService\IProductDomainService1;
use Domain\IRepository\IProductRepository1;

class ApplyDiscountUseCase
{
    private IProductRepository1 $productRepository;
    private IProductDomainService1 $productDomainService;

    public function __construct(IProductRepository1 $productRepository, IProductDomainService1 $productDomainService)
    {
        $this->productRepository = $productRepository;
        $this->productDomainService = $productDomainService;
    }

    public function execute(string $productId, float $discountPercentage): bool
    {
        $product = $this->productRepository->findById($productId);

        if (!$product) {
            throw new \InvalidArgumentException("Producto no encontrado.");
        }

        if (!$this->productDomainService->canApplyDiscount($product, $discountPercentage)) {
            return false; // No se puede aplicar el descuento
        }

        // Aplicar el descuento (ejemplo, modificando el precio unitario)
        $newPriceBase = $product->getUnitPrice()->getBasePrice() * (1 - $discountPercentage / 100);
        $product->setUnitPrice(new \Domain\ValueObject\Price($newPriceBase, $product->getUnitPrice()->getCurrency()));

        // Guardar cambios
        $this->productRepository->save($product);

        return true;
    }
}
