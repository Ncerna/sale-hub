<?php
namespace App\Application\Services;

use App\Application\Contracts\ProductServiceInterface;
use App\Application\UseCase\CreateProductUseCase;
use App\Application\UseCase\UpdateProductUseCase;
use App\Application\UseCase\DeleteProductUseCase;
use App\Application\UseCase\GetProductUseCase;
use App\Application\UseCase\ListProductUseCase;
use App\Domain\Entity\Product;
use App\Domain\Entity\ProductAttribute;
use App\Domain\ValueObject\Price;
use App\Domain\ValueObject\IGVRate;
use App\Domain\ValueObject\IGVAffectationCode;

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
                $attr['attributeId'],
                $attr['value']
            );
        }

        return new Product(
            $data['id'] ?? null,
            $data['name'],
            $data['code'],
            $data['barcode'] ?? null,
            $data['description'] ?? null,
            new Price($data['unitPrice']),
            isset($data['offerPrice']) ? new Price($data['offerPrice']) : null,
            new IGVRate($data['igvRate']),
            new IGVAffectationCode($data['igvAffectationCode']),
            $data['stock'],
            $data['minimumStock'],
            $data['photo'] ?? null,
            $data['productTypeId'] ?? null,
            $data['providerId'] ?? null,
            $data['unitsMeasureId'] ?? null,
            $data['status'] ?? 1,
            $data['company_id'] ?? null,
            $data['branch_id'] ?? null,
            $data['warehouse_id'] ?? null,
            $attributes
        );
    }
}

