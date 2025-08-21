<?php
namespace Infrastructure\Persistence;

use Domain\Entity\Product1;
use Domain\IRepository\IProductRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Product as EloquentProduct;

class EloquentProductRepository implements IProductRepository
{
    public function findById(string $id): ?Product1
    {
        $model = EloquentProduct::find($id);
        return $model ? $this->toDomainEntity($model) : null;
    }

    public function findAll(int $page, int $size, ?string $search = null): array
    {
        $query = EloquentProduct::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
        }

        $paginator = $query->paginate($size, ['*'], 'page', $page);

        return $paginator->getCollection()->map(function ($model) {
            return $this->toDomainEntity($model);
        })->toArray();
    }

    public function save(Product1 $product): void
    {
        $model = EloquentProduct::find($product->getId()) ?? new EloquentProduct();
        $model->id = $product->getId();
        $model->name = $product->getName();
        $model->code = $product->getCode();
        $model->base_price = $product->getUnitPrice()->getBasePrice();
        $model->igv_rate = $product->getIgvRate()->getValue();
        $model->stock = $product->getStock();
        // Mapear otros campos si aplica
        $model->save();
    }

    public function delete(Product1 $product): void
    {
        EloquentProduct::destroy($product->getId());
    }

    private function toDomainEntity(EloquentProduct $model): Product
    {
        return new Product(
            $model->id,
            $model->name,
            $model->code,
            new \Domain\ValueObject\Price($model->base_price, new \Domain\ValueObject\IGVRate($model->igv_rate)),
            new \Domain\ValueObject\IGVRate($model->igv_rate),
            // código efecto, stock y demás campos
            $model->stock,
            0 // mínimo stock como ejemplo
        );
    }
}
