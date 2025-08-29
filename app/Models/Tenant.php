<?php


namespace App\Models;

use Spatie\Multitenancy\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant
{
    // Puedes añadir nuevas propiedades o métodos propios aquí,
    // o redefinir métodos si es necesario para tu lógica de negocio.
    public function getTenantKey(): mixed
    {
        return $this->id; // Aquí estás devolviendo el id que se espera
    }
}

