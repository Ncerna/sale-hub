<?php

namespace Infrastructure\Persistence\Repository;
use Domain\Entity\CategoryAttribute;
use Infrastructure\Persistence\Eloquent\EloquentCategoryAttribute;
use Domain\IRepository\ICategoryAttributeRepository;
class CategoryAttributeRepository implements ICategoryAttributeRepository
{
   
    public function save(CategoryAttribute $attribute): void
    {
        $eloquent = $attribute->getId()
            ? EloquentCategoryAttribute::find($attribute->getId())
            : new EloquentCategoryAttribute();

        $eloquent->category_id = $attribute->getCategoryId();
        $eloquent->name = $attribute->getName();
        $eloquent->data_type = $attribute->getDataType();
        $eloquent->required = $attribute->isRequired();
        $eloquent->status = $attribute->getStatus();

        $eloquent->save();

        if (!$attribute->getId()) {
            $attribute->setId($eloquent->id);
        }
    }

    public function findById(int $id): ?CategoryAttribute
    {
        $eloquent = EloquentCategoryAttribute::find($id);
        if (!$eloquent) return null;

        return new CategoryAttribute(
            $eloquent->id,
            $eloquent->category_id,
            $eloquent->name,
            $eloquent->data_type,
            (bool)$eloquent->required,
            $eloquent->status
        );
    }

    public function findByCategoryId(int $categoryId): array
    {
        $attributes = [];
        foreach (EloquentCategoryAttribute::where('category_id', $categoryId)->get() as $eloquent) {
            $attributes[] = new CategoryAttribute(
                $eloquent->id,
                $eloquent->category_id,
                $eloquent->name,
                $eloquent->data_type,
                (bool)$eloquent->required,
                $eloquent->status
            );
        }
        return $attributes;
    }

   /* public function delete(int $id): void
    {
        EloquentCategoryAttribute::destroy($id);
    }*/
    public function delete(CategoryAttribute $attribute): void
    {
        if ($attribute->getId()) {
            EloquentCategoryAttribute::destroy($attribute->getId());
        }
    }
    public function deleteWhereCategoryIdAndNotIn(int $categoryId, array $idsToKeep): void
    {
        $query = EloquentCategoryAttribute::where('category_id', $categoryId);
        if (!empty($idsToKeep)) {
            $query->whereNotIn('id', $idsToKeep);
        }
        $query->delete();
    }
}
