<?php
namespace Infrastructure\Persistence\Eloquent;
use Illuminate\Database\Eloquent\Model;
class EloquentCategory extends Model
{
    protected $table = 'categories';
    protected $fillable = ['family_id', 'name', 'photo', 'description', 'status'];
    public $timestamps = true;
}