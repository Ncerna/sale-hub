<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentCategoryAttribute extends Model
{
    protected $table = 'category_attributes';
    protected $fillable = ['category_id', 'name', 'data_type', 'required', 'status'];
    public $timestamps = true;
}
