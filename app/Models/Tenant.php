<?php


namespace App\Models;
use Spatie\Multitenancy\Contracts\IsTenant;
use Spatie\Multitenancy\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements IsTenant
{
    protected $fillable = ['id', 'name', 'domain', 'database'];
}

