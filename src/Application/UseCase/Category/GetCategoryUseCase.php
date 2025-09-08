<?php

namespace Application\UseCase\Category;
use Domain\Entity\Category;
use Domain\IRepository\ICategoryRepository;
use Domain\IRepository\ICategoryAttributeRepository;
use Application\DTOs\CategoryRequest;
class GetCategoryUseCase
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
    public function execute(?int $id): array|Category
    {

        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            throw new \Exception("Category with ID {$id} not found.");
        }
        $attributes = $this->attributeRepository->findByCategoryId($id);
        foreach ($attributes as $attribute) {
            $category->addAttribute($attribute);
        }
        return $category;


    }

}




