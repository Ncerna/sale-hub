<?php
namespace Infrastructure\Persistence;

use Domain\Entity\Product1;
use Domain\IRepository\IProductRepository1;
use Domain\Entity\Product;
use Domain\ValueObject\Price;
use Domain\ValueObject\IGVRate;
use Domain\ValueObject\IGVAffectationCode;
use App\Models\Product1 as EloquentProduct; // Modelo Eloquent de Laravel

class ProductRepository1 implements IProductRepository1
{
    public function findById(string $id): ?Product1
    {
        $record = EloquentProduct::find($id);

        if (!$record) {
            return null;
        }

        return new Product1(
            $record->id,
            $record->name,
            $record->code,
            new Price($record->unit_price, new IGVRate($record->igv_rate)),
            new IGVRate($record->igv_rate),
            new IGVAffectationCode($record->igv_affectation_code),
            $record->stock,
            $record->minimum_stock,
            $record->barcode,
            $record->description,
            $record->photo,
            $record->category_id,
            $record->unit_id,
            $record->status,
            $record->company_id,
            $record->branch_id,
            $record->warehouse_id,
            
        );
    }

    public function save(Product1 $product): void
    {
        $record = EloquentProduct::updateOrCreate(
            ['id' => $product->getId()],
            [
                'name' => $product->getName(),
                'code' => $product->getCode(),
                'unit_price' => $product->getUnitPrice()->getBasePrice(),
                'igv_rate' => $product->getIgvRate()->getRate(),
                'igv_affectation_code' => $product->getIgvAffectationCode()->getCode(),
                'stock' => $product->getStock(),
                'minimum_stock' => $product->getMinimumStock(),
                'barcode' => $product->getBarcode(),
                'description' => $product->getDescription(),
                'photo' => $product->getPhoto(),
                'category_id' => $product->getCategoryId(),
                'unit_id' => $product->getUnitId(),
                'status' => $product->getStatus(),
                'company_id' => $product->getCompanyId(),
                'branch_id' => $product->getBranchId(),
                'warehouse_id' => $product->getWarehouseId(),
                'created_at' => $product->getCreatedAt(),
                'updated_at' => $product->getUpdatedAt()
            ]
        );
    }

    public function delete(string $id): void
    {
        EloquentProduct::destroy($id);
    }

    public function findByCode(string $code): ?Product1
    {
        $record = EloquentProduct::where('code', $code)->first();

        if (!$record) {
            return null;
        }

        return $this->findById($record->id);
    }
}
