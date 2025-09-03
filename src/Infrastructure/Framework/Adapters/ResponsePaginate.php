<?php
namespace Infrastructure\Framework\Adapters;

use App\Models\Role as EloquentRole;
use Domain\Entity\Role;

class ResponsePaginate
{
    /**
     * Formatea la respuesta de paginación
     * 
     * @param \Illuminate\Pagination\LengthAwarePaginator $paginator
     * @return array
     */
    public static function format($paginator): array
    {
        return [
            'page' => $paginator->currentPage(),
            'size' => $paginator->perPage(),
            'data' => $paginator->items(),
        ];
    }
}