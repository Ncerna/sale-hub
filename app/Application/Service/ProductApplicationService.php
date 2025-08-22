<?php
namespace Application\Service;

use Application\UseCase\RegisterProductUseCase;
use Application\UseCase\UpdateProductUseCase;
use Application\UseCase\DeleteProductUseCase;
use Application\UseCase\GetProductUseCase;
use Domain\Entity\Product;
use Domain\Entity\ProductAttribute;
use Domain\ValueObject\Price;
use Domain\ValueObject\IGVRate;
use Domain\ValueObject\IGVAffectationCode;

class ProductApplicationService
{
    private RegisterProductUseCase $registerUseCase;
    private UpdateProductUseCase $updateUseCase;
    private DeleteProductUseCase $deleteUseCase;
    private GetProductUseCase $getUseCase;

    public function __construct(
        RegisterProductUseCase $registerUseCase,
        UpdateProductUseCase $updateUseCase,
        DeleteProductUseCase $deleteUseCase,
        GetProductUseCase $getUseCase
    ) {
        $this->registerUseCase = $registerUseCase;
        $this->updateUseCase = $updateUseCase;
        $this->deleteUseCase = $deleteUseCase;
        $this->getUseCase = $getUseCase;
    }

    public function registerProduct(array $data): void
    {
        $product = $this->mapDataToProduct($data);
        $this->registerUseCase->execute($product);
    }

    public function updateProduct(string $id, array $data): void
    {
        $data['id'] = $id;
        $product = $this->mapDataToProduct($data);
        $this->updateUseCase->execute($product);
    }

    public function deleteProduct(string $id): void
    {
        $this->deleteUseCase->execute($id);
    }

    public function getProduct(string $id): ?Product
    {
        return $this->getUseCase->execute($id);
    }

    private function mapDataToProduct(array $data): Product
    {
        $attributes = [];

        foreach (($data['attributes'] ?? []) as $attrData) {
            $attributes[] = new ProductAttribute(
                $attrData['attribute_id'],
                $attrData['value']
            );
        }

        return new Product(
            $data['id'] ?? uniqid(),
            $data['name'],
            $data['code'],
            $data['barcode'] ?? null,
            $data['description'] ?? null,
            new Price($data['unit_price']),
            isset($data['offer_price']) ? new Price($data['offer_price']) : null,
            new IGVRate($data['igv_rate']),
            new IGVAffectationCode($data['igv_affectation_code']),
            $data['stock'],
            $data['minimum_stock'],
            $data['photo'] ?? null,
            $data['category_id'] ?? null,
            $data['unit_id'] ?? null,
            $data['provider_id'] ?? null,
            $data['status'] ?? 1,
            $data['company_id'] ?? null,
            $data['branch_id'] ?? null,
            $data['warehouse_id'] ?? null,
            isset($data['created_at']) ? new \DateTime($data['created_at']) : new \DateTime(),
            isset($data['updated_at']) ? new \DateTime($data['updated_at']) : new \DateTime(),
            $attributes
        );
    }
}
