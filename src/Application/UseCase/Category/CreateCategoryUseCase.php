<?php
namespace Application\UseCase\Category;
use Application\DTOs\CategoryRequest;
use Domain\Entity\Category;
use Domain\Entity\CategoryAttribute;
use Domain\IRepository\ICategoryRepository;
use Domain\IRepository\ICategoryAttributeRepository;

class CreateCategoryUseCase
{
    private ICategoryRepository $categoryRepository;
    private ICategoryAttributeRepository $attributeRepository;

    public function __construct(
        ICategoryRepository $categoryRepository,
        ICategoryAttributeRepository $attributeRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function execute(CategoryRequest $categoryRequest): array|Category
    {
      
        $attributes = [];
        foreach ($categoryRequest->attributes as $attrDTO) {
            $attributes[] = new CategoryAttribute(
                null,
                0, // category_id se asigna luego
                $attrDTO->name,
                $attrDTO->dataType,
                $attrDTO->required,
                $attrDTO->status
            );
        }
        $category = new Category(
            null,
            $categoryRequest->family_id,
            $categoryRequest->name,
            $categoryRequest->photo,
            $categoryRequest->description,
            $categoryRequest->status,
            $attributes
        );

        $this->categoryRepository->save($category);
        foreach ($category->getAttributes() as $attribute) {
            $attribute->setCategoryId($category->getId());
            $this->attributeRepository->save($attribute);
        }

        return $category;
    }
}
