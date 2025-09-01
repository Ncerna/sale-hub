<?php
namespace Domain\IRepository;

interface IRoleRepository {
public function exists(int $roleId): bool;
}
