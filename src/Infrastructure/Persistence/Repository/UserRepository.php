<?php
namespace Infrastructure\Persistence\Repository;

use Domain\Entity\User;
use Domain\IRepository\IUserRepository;

use Infrastructure\Framework\Adapters\UserAdapter;

class UserRepository implements IUserRepository
{
    public function save(User $user): User
    {
        $model = UserAdapter::toEloquent($user);
        $model->save();

        // Opcional: asignar ID generado
        if (!$user->getId()) {
            $reflection = new \ReflectionClass($user);
            $property = $reflection->getProperty('id');
            $property->setAccessible(true);
            $property->setValue($user, $model->id);
        }

        return $user;
    }

    public function update(User $user): User {
        // Busca, actualiza
        return $user;
    }

    public function delete(string $id): void {
        // Delete
    }

    public function findById(string $id): ?User {
        // Find
    }

    public function findAll(): array {
        
        return [];
    }
}
