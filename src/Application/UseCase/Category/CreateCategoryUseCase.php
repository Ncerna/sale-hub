<?php
namespace Application\UseCase\Category;
use Application\DTOs\CategoryRequest;
use Domain\Entity\Category;
use Application\DTOs\CategoryAttributeRequest;
use Domain\ValueObject\ModelMapper;
use Domain\Entity\CategoryAttribute;
use Domain\IRepository\ICategoryRepository;
use Domain\IRepository\ICategoryAttributeRepository;
use Domain\IService\ICategoryValidationService;

class CreateCategoryUseCase
{
    private ICategoryRepository $categoryRepository;
    private ICategoryAttributeRepository $attributeRepository;
    private ICategoryValidationService $validationService;

    public function __construct(
        ICategoryRepository $categoryRepository,
        ICategoryAttributeRepository $attributeRepository,
        ICategoryValidationService $validationService
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->attributeRepository = $attributeRepository;
        $this->validationService = $validationService;
    }

    public function execute(Category $category): Category
    {
        $this->validationService->validate($category);

        $createdCategory = $this->categoryRepository->save($category);

        foreach ($category->getAttributes() as $attribute) {
            $attribute->setCategoryId($createdCategory->getId());
            $this->attributeRepository->save($attribute);
        }

        $createdCategory->setAttributes($category->getAttributes());

        return $createdCategory;
    }

    public function execute_(CategoryRequest $categoryRequest): Category
{
    $category = ModelMapper::model_map($categoryRequest->toArray(), Category::class);
    $this->validationService->validate($category);
    $this->categoryRepository->save($category); // ahora ya tiene un ID

    $attributes = [];
    foreach ($categoryRequest->attributes as $attrDTO) {
        $attrDTO->setId(null); 
        $attrDTO->setCategoryId($category->getId()); 
        $attributes[] = $this->mapDTOToEntity($attrDTO);
    }
    $category->setAttributes($attributes);
    foreach ($category->getAttributes() as $attribute) {
        $this->attributeRepository->save($attribute);
    }

    return $category;
}

    private function mapDTOToEntity(CategoryAttributeRequest $dto): CategoryAttribute
    {
        return new CategoryAttribute(
            $dto->id ?? null,
            $dto->category_id ?? null,
            $dto->name,
            $dto->data_type,
            $dto->required,
            $dto->status
        );
    }
}
