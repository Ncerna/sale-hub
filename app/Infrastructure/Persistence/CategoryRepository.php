<?php
namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Category;
use App\Domain\IRepository\CategoryRepositoryInterface;
use App\Models\EloquentCategory;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function save(Category $category): void
    {
        $eloquent = $category->getId()
            ? EloquentCategory::find($category->getId())
            : new EloquentCategory();

        $eloquent->family_id = $category->getFamilyId();
        $eloquent->name = $category->getName();
        $eloquent->photo = $category->getPhoto();
        $eloquent->description = $category->getDescription();
        $eloquent->status = $category->getStatus();
        $eloquent->save();

        if (!$category->getId()) {
            $reflection = new \ReflectionClass($category);
            $property = $reflection->getProperty('id');
            $property->setAccessible(true);
            $property->setValue($category, $eloquent->id);
        }
    }

    public function findById(int $id): ?Category
    {
        $eloquent = EloquentCategory::find($id);
        if (!$eloquent) return null;

        // Aquí solo cargamos categoría, los atributos se cargan en repositorio de atributos o caso de uso
        return new Category(
            $eloquent->id,
            $eloquent->family_id,
            $eloquent->name,
            $eloquent->photo,
            $eloquent->description,
            $eloquent->status,
            []
        );
    }

    public function findAll(): array
    {
        $categories = [];
        foreach (EloquentCategory::all() as $eloquent) {
            $categories[] = new Category(
                $eloquent->id,
                $eloquent->family_id,
                $eloquent->name,
                $eloquent->photo,
                $eloquent->description,
                $eloquent->status,
                []
            );
        }
        return $categories;
    }

    public function delete(int $id): void
    {
        EloquentCategory::destroy($id);
    }
}
