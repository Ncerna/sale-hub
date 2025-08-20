<?php

namespace App\Application\UseCase;

use App\Application\DTO\CategoryDTO;
use App\Domain\Entity\Category;
use App\Domain\Entity\CategoryAttribute;
use App\Domain\IRepository\CategoryRepositoryInterface;
use App\Domain\IRepository\CategoryAttributeRepositoryInterface;

class CreateCategoryUseCase
{
    private CategoryRepositoryInterface $categoryRepository;
    private CategoryAttributeRepositoryInterface $attributeRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        CategoryAttributeRepositoryInterface $attributeRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function execute(CategoryDTO $dto): Category
    {
        $attributes = [];
        foreach ($dto->attributes as $attrDTO) {
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
            $dto->familyId,
            $dto->name,
            $dto->photo,
            $dto->description,
            $dto->status,
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
