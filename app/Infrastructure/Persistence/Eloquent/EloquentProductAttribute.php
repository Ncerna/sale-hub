<?php

namespace App\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EloquentProductAttribute extends Model
{
    protected $table = 'product_attributes';

    protected $fillable = [
        'product_id',
        'attribute_id',
        'value',
    ];

    public $timestamps = false;

    public function product(): BelongsTo
    {
        return $this->belongsTo(EloquentProduct::class, 'product_id', 'id');
    }
}
