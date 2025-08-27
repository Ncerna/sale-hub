<?php
namespace Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class EloquentProduct extends Model
{
    protected $table = 'products';  // Nombre de la tabla en la base de datos

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'id',
        'name',
        'code',
        'barcode',
        'description',
        'unit_price',
        'offer_price',
        'igv_rate',
        'igv_affectation_code',
        'stock',
        'minimum_stock',
        'photo',
        'product_type_id',
        'provider_id',
        'units_measure_id',
        'status',
        'company_id',
        'branch_id',
        'warehouse_id',
    ];

    public $timestamps = true;

    // Relación con atributos del producto
    public function attributes(): HasMany
    {
        return $this->hasMany(EloquentProductAttribute::class, 'product_id', 'id');
    }
}
