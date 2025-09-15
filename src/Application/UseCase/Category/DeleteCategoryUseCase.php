<?php

namespace Application\UseCase\Category;

use Domain\IRepository\ICategoryRepository;
use Domain\Entity\Category;
use Exception;

class DeleteCategoryUseCase
{
    private ICategoryRepository $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute(int $categoryId): Category
    {
        $category = $this->categoryRepository->findById($categoryId);

        if (!$category) {
            throw new Exception("Categoría no encontrada con ID: {$categoryId}");
        }
        $this->categoryRepository->delete($categoryId);
        return $category;
    }
}
