<?php

namespace Application\UseCase;

use Application\DTOs\CategoryDTO;
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

    public function execute(CategoryDTO $DTOs): Category
    {
        $attributes = [];
        foreach ($DTOs->attributes as $attrDTO) {
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
            $DTOs->familyId,
            $DTOs->name,
            $DTOs->photo,
            $DTOs->description,
            $DTOs->status,
            $attributes
        );

        $this->categoryRepository->save($category);

        // Guardar atributos con el category_id generado
        foreach ($category->getAttributes() as $attribute) {
            $reflection = new \ReflectionClass($attribute);
            $property = $reflection->getProperty('categoryId');
            $property->setAccessible(true);
            $property->setValue($attribute, $category->getId());

            $this->attributeRepository->save($attribute);
        }

        return $category;
    }
}
