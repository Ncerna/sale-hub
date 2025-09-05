<?php
namespace Application\Services;

use Application\Contracts\CategoryServiceInterface;
use Application\UseCase\Category\CreateCategoryUseCase;
use Application\UseCase\Category\UpdateCategoryUseCase;

use Domain\Entity\CategoryAttribute;
use Application\DTOs\CategoryRequest;

class CategoryService implements CategoryServiceInterface
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

    public function registerCategory(array $data): array
    {
        $product = $this->mapDataToProduct($data);
        return $this->createProductUseCase->execute($product);
    }

    public function updateCategory( array $data,int $id,): array
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