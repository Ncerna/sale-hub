<?php
namespace Application\Services;
use Application\Contracts\CategoryServiceInterface;
use Application\UseCase\Category\CreateCategoryUseCase;
use Application\UseCase\Category\GetCategoryUseCase;
use Application\UseCase\Category\UpdateCategoryUseCase;
use Infrastructure\Framework\Adapters\ObjectToArrayMapper;
use Application\DTOs\CategoryAttributeRequest;
use Application\DTOs\CategoryRequest;
class CategoryService implements CategoryServiceInterface
{
    private CreateCategoryUseCase $createUseCase;
    private UpdateCategoryUseCase $updateUseCase;
    private GetCategoryUseCase $getUseCase;
    public function __construct(
        CreateCategoryUseCase $createUseCase,
        UpdateCategoryUseCase $updateUseCase,
        GetCategoryUseCase $getUseCase
    ) {
        $this->createUseCase = $createUseCase;
        $this->updateUseCase = $updateUseCase;
        $this->getUseCase=$getUseCase;

    }
    public function registeCategory(array $data): array
    {
        $category = $this->mapDataToCategory($data);
        $category->setId(null);
        $response = $this->createUseCase->execute($category);
        return ObjectToArrayMapper::map($response);

    }

    public function updateCategory(array $data, int $id): array
    {
        $category = $this->mapDataToCategory($data);
        $category->setId($id);
        $response = $this->updateUseCase->execute($category);
        return ObjectToArrayMapper::map($response);
    }
    public function getCategory( int $id): array
    {
        if (!$id)  throw new \Exception("Category id is requerid .");
       $response = $this->getUseCase->execute($id);
          return ObjectToArrayMapper::map($response);
    }

    private function mapDataToCategory(array $data): CategoryRequest
    {
        $categoryDto = CategoryRequest::fromArray($data);
        $attributes = [];
        foreach ($categoryDto->getAttributes() as $attrArray) {
            $attributes[] = CategoryAttributeRequest::fromArray($attrArray);
        }
        $categoryDto->setAttributes($attributes);
        return $categoryDto;
    }
}