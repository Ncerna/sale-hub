<?php
namespace Infrastructure\Persistence;

use Domain\IRepository\IProductRepository;
use Domain\Entity\Product;
use Domain\Entity\ProductAttribute;
use Infrastructure\Eloquent\Models\ProductModel;
use Infrastructure\Eloquent\Models\ProductAttributeModel;
use Domain\ValueObject\Price;
use Domain\ValueObject\IGVRate;
use Domain\ValueObject\IGVAffectationCode;

class EloquentProductRepository implements IProductRepository
{
    public function save(Product $product): Product
    {
        ProductModel::create([
            'id' => $product->getId(),
            'name' => $product->getName(),
            'code' => $product->getCode(),
            'barcode' => $product->getBarcode(),
            'description' => $product->getDescription(),
            'unit_price' => $product->getUnitPrice()->getBasePrice(),
            'offer_price' => $product->getOfferPrice() ? $product->getOfferPrice()->getBasePrice() : null,
            'igv_rate' => $product->getIgvRate()->getRate(),
            'igv_affectation_code' => $product->getIgvAffectationCode()->getCode(),
            'stock' => $product->getStock(),
            'minimum_stock' => $product->getMinimumStock(),
            'photo' => $product->getPhoto(),
            'product_type_id' => $product->getProductTypeId(),
            'provider_id' => $product->getProviderId(),
            'units_measure_id' => $product->getUnitsMeasureId(),
            'status' => $product->getStatus(),
            'company_id' => $product->getCompanyId(),
            'branch_id' => $product->getBranchId(),
            'warehouse_id' => $product->getWarehouseId(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->saveAttributes($product->getId(), $product->getAttributes());

        return $product;
    }

    public function findById(int $id): ?Product
    {
        $model = ProductModel::find($id);
        if (!$model) {
            return null;
        }

        $attributes = $this->getAttributes($model->id);

        return new Product(
            $model->id,
            $model->name,
            $model->code,
            $model->barcode,
            $model->description,
            new Price($model->unit_price),
            $model->offer_price ? new Price($model->offer_price) : null,
            new IGVRate($model->igv_rate),
            new IGVAffectationCode($model->igv_affectation_code),
            $model->stock,
            $model->minimum_stock,
            $model->photo,
            $model->product_type_id,
            $model->provider_id,
            $model->units_measure_id,
            $model->status,
            $model->company_id,
            $model->branch_id,
            $model->warehouse_id,
            $attributes
        );
    }

    public function update(Product $product): Product
    {
        $model = ProductModel::find($product->getId());
        if (!$model) {
            throw new \Exception("Product not found.");
        }

        $model->update([
            'name' => $product->getName(),
            'code' => $product->getCode(),
            'barcode' => $product->getBarcode(),
            'description' => $product->getDescription(),
            'unit_price' => $product->getUnitPrice()->getBasePrice(),
            'offer_price' => $product->getOfferPrice() ? $product->getOfferPrice()->getBasePrice() : null,
            'igv_rate' => $product->getIgvRate()->getRate(),
            'igv_affectation_code' => $product->getIgvAffectationCode()->getCode(),
            'stock' => $product->getStock(),
            'minimum_stock' => $product->getMinimumStock(),
            'photo' => $product->getPhoto(),
            'product_type_id' => $product->getProductTypeId(),
            'provider_id' => $product->getProviderId(),
            'units_measure_id' => $product->getUnitsMeasureId(),
            'status' => $product->getStatus(),
            'company_id' => $product->getCompanyId(),
            'branch_id' => $product->getBranchId(),
            'warehouse_id' => $product->getWarehouseId(),
            'updated_at' => now(),
        ]);

        $this->saveAttributes($product->getId(), $product->getAttributes());

        return $product;
    }

    public function delete(int $id): bool
    {
        $this->deleteAttributes($id);
        return ProductModel::destroy($id) > 0;
    }

    public function findAll(): array
    {
        $models = ProductModel::all();
        $products = [];
        foreach ($models as $model) {
            $products[] = $this->findById($model->id);
        }
        return $products;
    }

    // Si tienes paginación y búsqueda, implementar list()

    protected function saveAttributes(string $productId, array $attributes): void
    {
        $this->deleteAttributes($productId);

        foreach ($attributes as $attribute) {
            ProductAttributeModel::create([
                'producto_id' => $productId,
                'atributo_id' => $attribute->getAttributeId(),
                'valor' => $attribute->getValue(),
                'creado_en' => now(),
                'actualizado_en' => now(),
            ]);
        }
    }

    protected function deleteAttributes(string $productId): void
    {
        ProductAttributeModel::where('producto_id', $productId)->delete();
    }

    protected function getAttributes(string $productId): array
    {
        $models = ProductAttributeModel::where('producto_id', $productId)->get();

        $attributes = [];
        foreach ($models as $model) {
            $attributes[] = new ProductAttribute($model->atributo_id, $model->valor);
        }
        return $attributes;
    }

    public function findByCode(string $code): ?Product
    {
        $model = ProductModel::where('code', $code)->first();
        if (!$model) return null;
        return $this->findById($model->id);
    }

    public function list(int $page, int $size, ?string $search = null): array
    {
        $query = ProductModel::query();

        if (!empty($search)) {
            $query->where('name', 'like', "%$search%")
                  ->orWhere('code', 'like', "%$search%");
        }

        $models = $query->paginate($size, ['*'], 'page', $page);

        $products = [];
        foreach ($models as $model) {
            $products[] = $this->findById($model->id);
        }

        return $products;
    }
}
