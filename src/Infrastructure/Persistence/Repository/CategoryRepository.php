<?php

namespace Infrastructure\Persistence\Repository;
use Domain\Entity\Category;
use Infrastructure\Persistence\Eloquent\EloquentCategory;
use Domain\IRepository\ICategoryRepository;
use Application\DTOs\CategoryRequest;

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
    return EloquentCategory::all()->map(fn($e) =>
     $this->mapToDomain($e))->all();
}


    public function delete(int $id): void
    {
        EloquentCategory::destroy($id);
    }
    
     private function mapToDomain(EloquentCategory $eloquent): Category
     {
         $category = new Category();
     
         $category->setId($eloquent->id);
         $category->setFamily_id($eloquent->family_id);
         $category->setName($eloquent->name);
         $category->setPhoto($eloquent->photo);
         $category->setDescription($eloquent->description);
         $category->setStatus($eloquent->status);
         $category->setAttributes([]); // los atributos se cargan por otro repositorio
     
         return $category;
     }
     
     public function updateCategoryWithAttributes(CategoryRequest $request, $id)
     {
         // Buscar la categoría o lanzar error 404 si no existe
         $category = EloquentCategory::findOrFail($id);;
     
         // Validar datos principales de la categoría y los atributos
       
     
         // Actualizar datos de la categoría
         //setear sus propiedades
         $category->update(); //guardar 
     
         $attributesInput =  $request->getAttributes ?? [];
     
         // IDs de atributos enviados en la petición
         $attributesIds = collect($attributesInput)->pluck('id')->filter()->toArray();
     
         // Eliminar atributos que no están en la petición (sólo los que pertenecen a esta categoría)
         $category->attributes()->whereNotIn('id', $attributesIds)->delete();
     
         // Actualizar o crear atributos según existan o no
         foreach ($attributesInput as $attrData) {
             if (isset($attrData['id'])) {
                 // Actualizar atributo existente
                 $attribute = $category->attributes()->find($attrData['id']);
                 if ($attribute) {
                     $attribute->update([
                         'name' => $attrData['name'],
                         // Otros campos del atributo aquí
                     ]);
                 }
             } else {
                 // Crear nuevo atributo para la categoría
                 $category->attributes()->create([
                     'name' => $attrData['name'],
                     // Otros campos del atributo aquí
                 ]);
             }
         }
     
         return redirect()->route('categories.index')->with('success', 'Categoría y atributos actualizados correctamente');
     }


}

