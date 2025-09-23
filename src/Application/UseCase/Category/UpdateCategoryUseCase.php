<?php

namespace Application\UseCase\Category;
use Application\DTOs\CategoryAttributeRequest;
use Domain\Entity\CategoryAttribute;
use Domain\Entity\Category;
use Domain\IRepository\ICategoryRepository;
use Domain\IService\ICategoryValidationService;
use Domain\IRepository\ICategoryAttributeRepository;
use Application\DTOs\CategoryRequest;
class UpdateCategoryUseCase
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

        $updatedCategory = $this->categoryRepository->save($category);

        $attributes = $category->getAttributes();
        $attributeIdsToKeep = [];

        foreach ($attributes as $attribute) {
            $attribute->setCategoryId($updatedCategory->getId());
            $this->attributeRepository->save($attribute);
            if ($attribute->getId() !== null) {
                $attributeIdsToKeep[] = $attribute->getId();
            }
        }

        $this->attributeRepository->deleteWhereCategoryIdAndNotIn(
            $updatedCategory->getId(),
            $attributeIdsToKeep
        );

        $updatedCategory->setAttributes($attributes);

        return $updatedCategory;
    }

    

    public function execute_(CategoryRequest $categoryRequest): Category
    {
        $category = $this->loadCategory($categoryRequest);
        $existingAttributes = $this->loadExistingAttributes($category);
        $incomingAttributes = $categoryRequest->attributes ?? [];

        $receivedAttributeIds = $this->syncAttributes($category, $incomingAttributes, $existingAttributes);

        $this->removeDeletedAttributes($category, $existingAttributes, $receivedAttributeIds);

        $this->categoryRepository->save($category);

        return $category;
    }
    private function loadCategory(CategoryRequest $request): Category
    {
        $category = $this->categoryRepository->findById($request->id);

        if (!$category) {
            throw new \Exception("Category with ID {$request->id} not found.");
        }

        $category->fillFromArray($request->toArray());

        return $category;
    }
    private function loadExistingAttributes(Category $category): array
    {
        $attributes = $this->attributeRepository->findByCategoryId($category->getId());

        foreach ($attributes as $attr) {
            $category->addAttribute($attr);
        }

        $mapped = [];
        foreach ($category->getAttributes() as $attr) {
            if ($attr instanceof CategoryAttributeRequest) {
                $mapped[] = $this->mapDTOToEntity($attr);
            }
        }

        return $mapped;
    }
    private function syncAttributes(Category $category, array $incoming, array $existing): array
{
    $existingById = [];

    foreach ($existing as $attr) {
        $existingById[$attr->getId()] = $attr;
    }

    $receivedIds = [];

    foreach ($incoming as $attrDTO) {
        if (isset($attrDTO->id) && isset($existingById[$attrDTO->id])) {
            // Actualizar
            $existing = $existingById[$attrDTO->id];
            $existing->setName($attrDTO->name);
            $existing->setDataType($attrDTO->data_type);
            $existing->setRequired($attrDTO->required);
            $existing->setStatus($attrDTO->status);
            $this->attributeRepository->save($existing);
            $receivedIds[] = $attrDTO->id;
        } else {
            // Crear nuevo
            $newAttr = $this->mapDTOToEntity($attrDTO);
            $newAttr->setCategoryId($category->getId());
            $this->attributeRepository->save($newAttr);
            $category->addAttribute($newAttr);
            if ($newAttr->getId()) {
                $receivedIds[] = $newAttr->getId();
            }
        }
    }

    return $receivedIds;
}
private function removeDeletedAttributes(Category $category, array $existing, array $receivedIds): void
{
    foreach ($existing as $attr) {
        if (!in_array($attr->getId(), $receivedIds)) {
            $this->attributeRepository->delete($attr);
            $category->removeAttribute($attr);
        }
    }
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
