<?php

namespace Infrastructure\Persistence\Repository;
use Domain\Entity\Category;
use Infrastructure\Persistence\Eloquent\EloquentCategory;
use Domain\IRepository\ICategoryRepository;

class CategoryRepository implements ICategoryRepository
{
    public function save(Category $category): void
    {
        $eloquent = $category->getId()
            ? EloquentCategory::find($category->getId())
            : new EloquentCategory();

         $eloquent->fill($category->toArray()); 
        $eloquent->save();
        if (!$category->getId()) {
            $category->setId($eloquent->id);
        }
    }

    public function findById(int $id): ?Category
{
    $eloquent = EloquentCategory::find($id);
    if (!$eloquent) return null;

    return $this->mapToDomain($eloquent);
}

public function findAll(): array
{
    return EloquentCategory::all()->map(fn($e) => $this->mapToDomain($e))->all();
}


    public function delete(int $id): void
    {
        EloquentCategory::destroy($id);
    }
     public function findAllPaginated(int $page, int $size, ?string $search): array{
        return [];
     }
     private function mapToDomain(EloquentCategory $eloquent): Category
     {
         $category = new Category();
     
         $category->setId($eloquent->id);
         $category->setFamilyId($eloquent->family_id);
         $category->setName($eloquent->name);
         $category->setPhoto($eloquent->photo);
         $category->setDescription($eloquent->description);
         $category->setStatus($eloquent->status);
         $category->setAttributes([]); // los atributos se cargan por otro repositorio
     
         return $category;
     }
     

}

