<?php

namespace Infrastructure\Persistence\Repository;
use Domain\IRepository\IRoleRepository;
use Infrastructure\Persistence\Eloquent\EloquentRole;
class RoleRepository implements IRoleRepository
{
    protected $model;

    public function __construct(EloquentRole $model)
    {
        $this->model = $model;
    }

    public function exists(int $roleId): bool
    {
        return $this->model->where('id', $roleId)->exists();
    }
}
