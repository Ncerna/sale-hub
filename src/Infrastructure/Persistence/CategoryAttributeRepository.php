<?php
namespace Infrastructure\Persistence;

use Domain\Entity\CategoryAttribute;
use Domain\IRepository\ICategoryAttributeRepository;
use App\Models\EloquentCategoryAttribute;

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
            $reflection = new \ReflectionClass($attribute);
            $property = $reflection->getProperty('id');
            $property->setAccessible(true);
            $property->setValue($attribute, $eloquent->id);
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

    public function delete(int $id): void
    {
        EloquentCategoryAttribute::destroy($id);
    }
}
