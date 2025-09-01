<?php
namespace Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EloquentRole extends Model
{
    protected $table = 'roles';

    protected $fillable = [
       'id', 'role_name'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(EloquentUser::class, 'role_id');
    }
}
