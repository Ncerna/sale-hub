<?php
namespace Application\Services;

use Application\Contracts\ProductServiceInterface;
use Application\UseCase\Product\CreateProductUseCase;
use Application\UseCase\Product\UpdateProductUseCase;
use Application\UseCase\Product\ListProductUseCase;

use Application\UseCase\DeleteProductUseCase;
use Application\UseCase\GetProductUseCase;

use Domain\Entity\Product;
use Domain\Entity\ProductAttribute;
use Domain\ValueObject\Price;
use Domain\ValueObject\IGVRate;
use Domain\ValueObject\IGVAffectationCode;
use Domain\ValueObject\ModelMapper;
use Application\DTOs\ProductRequest;

class ProductService implements ProductServiceInterface
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

    private function mapDataToProduct(array $data): ProductRequest
   {
    $attributes = [];
    foreach ($data['attributes'] ?? [] as $attr) {
        $attributes[] = ProductAttribute::fromArray($attr);
    }
    $productdto = ProductRequest::fromArray($data);
    $productdto->setAttributes($attributes);
    return $productdto;
}

}

