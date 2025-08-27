<?php
namespace Application\Services;

use Application\Contracts\ProductServiceInterface;
use Application\UseCase\CreateProductUseCase;
use Application\UseCase\UpdateProductUseCase;
use Application\UseCase\DeleteProductUseCase;
use Application\UseCase\GetProductUseCase;
use Application\UseCase\ListProductUseCase;
use Domain\Entity\Product;
use Domain\Entity\ProductAttribute;
use Domain\ValueObject\Price;
use Domain\ValueObject\IGVRate;
use Domain\ValueObject\IGVAffectationCode;

class ProductApplicationService implements ProductServiceInterface
{
    private CreateProductUseCase $createProductUseCase;
    private UpdateProductUseCase $updateUseCase;
    private DeleteProductUseCase $deleteUseCase;
    private GetProductUseCase $getUseCase;
    private ListProductUseCase $listUseCase;

    public function __construct(
        CreateProductUseCase $createProductUseCase,
        UpdateProductUseCase $updateUseCase,
        DeleteProductUseCase $deleteUseCase,
        GetProductUseCase $getUseCase,
        ListProductUseCase $listUseCase
    ) {
        $this->createProductUseCase = $createProductUseCase;
        $this->updateUseCase = $updateUseCase;
        $this->deleteUseCase = $deleteUseCase;
        $this->getUseCase = $getUseCase;
        $this->listUseCase = $listUseCase;
    }

    public function registerProduct(array $data): Product
    {
        $product = $this->mapDataToProduct($data);
        return $this->createProductUseCase->execute($product);
    }

    public function updateProduct(int $id, array $data): Product
    {
        $data['id'] = $id;
        $product = $this->mapDataToProduct($data);
        return $this->updateUseCase->execute($product);
    }

    public function deleteProduct(int $id): void
    {
        $this->deleteUseCase->execute($id);
    }

    public function getProduct(int $id): ?Product
    {
        return $this->getUseCase->execute($id);
    }

    public function listAll(int $page, int $size, ?string $search = null): array
    {
        return $this->listUseCase->execute($page, $size, $search);
    }

    private function mapDataToProduct(array $data): Product
{
    $attributes = [];
    foreach (($data['attributes'] ?? []) as $attr) {
        $attributes[] = new ProductAttribute(
            $attr['attribute_id'],
            $attr['value']
        );
    }
    $igvRateValue = ($data['igv_rate'] ?? 0) / 100;
    $igvRate = new IGVRate($igvRateValue);
    return new Product(
        $data['id'] ?? null,
        $data['name'],
        $data['code'],
        $data['barcode'] ?? null,
        $data['description'] ?? null,
        $price = new Price($data['unit_price'], $igvRate),
        isset($data['offer_price']) ? new Price($data['offer_price'],$igvRate) : null,
        new IGVRate($data['igv_rate']),
        new IGVAffectationCode($data['igv_affectation_code']),
        $data['stock'],
        $data['minimum_stock'],
        $data['photo'] ?? null,
        $data['product_type_id'] ?? null,
        $data['provider_id'] ?? null,
        $data['units_measure_id'] ?? null,
        $data['status'] ?? 1,
        $data['company_id'] ?? null,
        $data['branch_id'] ?? null,
        $data['warehouse_id'] ?? null,
        $attributes
    );
}

}

