<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'products';
   protected $fillable = [
        'id', 'name', 'code', 'barcode', 'description', 'unit_price', 'offer_price',
        'igv_rate', 'igv_affectation_code', 'stock', 'minimum_stock', 'photo',
        'category_id', 'unit_id', 'provider_id', 'status', 'company_id',
        'branch_id', 'warehouse_id'
    ];
}
https://www.perplexity.ai/search/mira-entiende-bien-esto-estoy-KRt9jcuySCaAVrl4ZBXAhw
