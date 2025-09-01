<?php
namespace Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class EloquentUser extends Model
{
    protected $table = 'users';
     protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'username',
        'password',
        'email',
        'phone_number',
        'address',
        'role_id',      // debe coincidir con el nombre de la columna en la tabla
        'status',
        'path_photo',
        'path_qr'
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(EloquentRole::class, 'role_id');
    }
}

