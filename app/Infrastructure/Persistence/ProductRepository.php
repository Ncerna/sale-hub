<?php
namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Product;
use App\Domain\IRepository\IProductRepository;
use App\Models\ProductModel;

class ProductRepository implements IProductRepository
{
    public function save(Product $product): Product
    {
        $model = new ProductModel();
        $model->name = $product->getName();
        $model->price = $product->getPrice();
        $model->stock = $product->getStock();
        $model->save();

        return new Product($model->id, $model->name, $model->price, (int)$model->stock);
    }

    public function findById(int $id): ?Product
    {
        $model = ProductModel::find($id);
        if (!$model) return null;
        return new Product($model->id, $model->name, $model->price, (int)$model->stock);
    }

    public function findAll(): array
    {
        $models = ProductModel::all();
        return $models->map(fn($m) => new Product($m->id, $m->name, $m->price, (int)$m->stock))->toArray();
    }

    public function delete(int $id): bool
    {
        return ProductModel::destroy($id) > 0;
    }

    public function update(Product $product): Product
    {
        $model = ProductModel::find($product->getId());
        if (!$model) {
            throw new \Exception("Product not found");
        }
        $model->name = $product->getName();
        $model->price = $product->getPrice();
        $model->stock = $product->getStock();
        $model->save();

        return new Product($model->id, $model->name, $model->price, (int)$model->stock);
    }
}
