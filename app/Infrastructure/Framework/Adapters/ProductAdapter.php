<?php
namespace App\Infrastructure\Framework\Adapters;


use App\Infrastructure\Persistence\Eloquent\EloquentProduct;
use App\Infrastructure\Persistence\Eloquent\EloquentProductAttribute;
use App\Domain\Entity\Product;
use App\Domain\Entity\ProductAttribute;
use App\Domain\ValueObject\Price;
use App\Domain\ValueObject\IGVRate;
use App\Domain\ValueObject\IGVAffectationCode;

class ProductAdapter
{
    /**
     * Convierte un modelo EloquentProduct en una entidad de dominio Product.
     *
     * @param EloquentProduct $eloquentProduct
     * @return Product
     */
    public static function toEntity(EloquentProduct $eloquentProduct): Product
    {
        $attributes = [];
        foreach ($eloquentProduct->attributes as $attrModel) {
            $attributes[] = new ProductAttribute(
                $attrModel->attribute_id,
                $attrModel->value
            );
        }

        return new Product(
            $eloquentProduct->id?? null,
            $eloquentProduct->name,
            $eloquentProduct->code,
            $eloquentProduct->barcode,
            $eloquentProduct->description,
            new Price($eloquentProduct->unit_price,new IGVRate(0)),
            $eloquentProduct->offer_price ? new Price($eloquentProduct->offer_price,new IGVRate(0)) : null,
            new IGVRate($eloquentProduct->igv_rate),
            new IGVAffectationCode($eloquentProduct->igv_affectation_code),
            $eloquentProduct->stock,
            $eloquentProduct->minimum_stock,
            $eloquentProduct->photo,
            $eloquentProduct->product_type_id,
            $eloquentProduct->provider_id,
            $eloquentProduct->units_measure_id,
            $eloquentProduct->status,
            $eloquentProduct->company_id,
            $eloquentProduct->branch_id,
            $eloquentProduct->warehouse_id,
            $attributes
        );
    }

    /**
     * Convierte una entidad de dominio Product en un modelo EloquentProduct.
     *
     * @param Product $product
     * @param EloquentProduct|null $model (opcional para actualizar modelo existente)
     * @return EloquentProduct
     */
    public static function toEloquent(Product $product, EloquentProduct $model = null): EloquentProduct
    {
        if ($model === null) {
            $model = new EloquentProduct();
        }
        
        $model->id = $product->getId();
        $model->name = $product->getName();
        $model->code = $product->getCode();
        $model->barcode = $product->getBarcode();
        $model->description = $product->getDescription();
        $model->unit_price = $product->getUnitPrice()->getBasePrice();
        $model->offer_price = $product->getOfferPrice()?->getBasePrice();
        $model->igv_rate = $product->getIgvRate()->getRate();
        $model->igv_affectation_code = $product->getIgvAffectationCode()->getCode();
        $model->stock = $product->getStock();
        $model->minimum_stock = $product->getMinimumStock();
        $model->photo = $product->getPhoto();
        $model->product_type_id = $product->getProductTypeId();
        $model->provider_id = $product->getProviderId();
        $model->units_measure_id = $product->getUnitsMeasureId();
        $model->status = $product->getStatus();
        $model->company_id = $product->getCompanyId();
        $model->branch_id = $product->getBranchId();
        $model->warehouse_id = $product->getWarehouseId();

        return $model;
    }

    /**
     * Sincroniza los atributos de la entidad Product con el modelo EloquentProductAttribute.
     *
     * @param Product $product
     * @param EloquentProduct $eloquentProduct
     * @return void
     */
    public static function syncAttributes(Product $product, EloquentProduct $eloquentProduct): void
    {
        $existingAttributes = EloquentProductAttribute::where('product_id', $eloquentProduct->id)
            ->pluck('id', 'attribute_id')
            ->toArray();

        foreach ($product->getAttributes() as $attribute) {
            if (isset($existingAttributes[$attribute->getAttributeId()])) {
                $attrModel = EloquentProductAttribute::find($existingAttributes[$attribute->getAttributeId()]);
            } else {
                $attrModel = new EloquentProductAttribute();
                $attrModel->product_id = $eloquentProduct->id;
                $attrModel->attribute_id = $attribute->getAttributeId();
            }
            $attrModel->value = $attribute->getValue();
            $attrModel->save();
        }
    }
}
