<?php
namespace Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class EloquentUser extends Model
{
    protected $table = 'users';
    protected $hidden = ['password'];


    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'username',
        'password',
        'email',
        'phone_number',
        'address',
        'role_id',    
        'status',
        'path_photo',
        'path_qr'
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(EloquentRole::class, 'role_id');
    }
    

}

