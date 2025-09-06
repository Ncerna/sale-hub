<?php
namespace Application\Services;

use Application\Contracts\CategoryServiceInterface;
use Application\UseCase\Category\CreateCategoryUseCase;
use Application\UseCase\Category\UpdateCategoryUseCase;

use Application\DTOs\CategoryAttributeRequest;
use Application\DTOs\CategoryRequest;

class CategoryService implements CategoryServiceInterface
{
    private CreateCategoryUseCase $createUseCase;
    private UpdateCategoryUseCase $updateUseCase;


    public function __construct(
        CreateCategoryUseCase $createUseCase,
        UpdateCategoryUseCase $updateUseCase, 
      
    ) {
        $this->createUseCase = $createUseCase;
        $this->updateUseCase = $updateUseCase;
    
    }
    public function registeCategory(array $data): array{
        $category = $this->mapDataToCategory($data);
        return $this->createUseCase->execute($category);
    }
  
    public function updateCategory( array $data,int $id,): array
    {
        $data['id'] = $id;
        $category = $this->mapDataToCategory($data);
        return $this->updateUseCase->execute($category);
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