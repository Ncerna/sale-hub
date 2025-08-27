<?php

namespace Infrastructure\Persistence\Repository;
use Domain\Entity\Product;
use Infrastructure\Persistence\Eloquent\EloquentProduct;
use Infrastructure\Framework\Adapters\ProductAdapter;
use Domain\IRepository\IProductRepository;


class ProductRepository implements IProductRepository
{
    public function save(Product $product): Product
    {
        // Intentar buscar el modelo Eloquent existente
        $eloquent = null;
        if ($product->getId()) {
            $eloquent = EloquentProduct::find($product->getId());
        }
        // Convertir entidad dominio a modelo Eloquent (nuevo o existente)
        $eloquent = ProductAdapter::toEloquent($product, $eloquent);

        $eloquent->save();

        // Si es nuevo producto, asignar ID generado a entidad dominio
        if (!$product->getId()) {
            $reflection = new \ReflectionClass($product);
            $property = $reflection->getProperty('id');
            $property->setAccessible(true);
            $property->setValue($product, $eloquent->id);
        }

        // Sincronizar atributos relacionados usando adapter
        ProductAdapter::syncAttributes($product, $eloquent);
        return $product;
    }

    public function findById(int $id): ?Product
    {
        $eloquent = EloquentProduct::with('attributes')->find($id);

        if (!$eloquent) {
            return null;
        }

        // Convertir modelo Eloquent a entidad dominio
        return ProductAdapter::toEntity($eloquent);
    }

    public function delete(int $id): bool
    {
        $eloquent = EloquentProduct::find($id);
        if ($eloquent) {
            $eloquent->attributes()->delete();
            $eloquent->delete();
        }
        return true;
    }

    public function list(int $page, int $size, ?string $search = null): array
    {
        $query = EloquentProduct::with('attributes');

        if ($search) {
            $query->where('name', 'like', "%$search%")
                  ->orWhere('code', 'like', "%$search%");
        }

        $paginator = $query->paginate($size, ['*'], 'page', $page);

        $products = [];
        foreach ($paginator->items() as $eloquent) {
            $products[] = ProductAdapter::toEntity($eloquent);
        }

        return $products;
    }
     public function findAll(): array
    {
       

        return [];
    }
        public function findByCode(String $code): ?Product
    {
        

        // Convertir modelo Eloquent a entidad dominio
        return null;
    }
}
