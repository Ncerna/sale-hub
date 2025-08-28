<?php
namespace Infrastructure\Persistence\Repository;
use Domain\Entity\User;
use Domain\IRepository\IUserRepository;
use Infrastructure\Persistence\Eloquent\EloquentUser;
use Infrastructure\Framework\Adapters\UserAdapter;
class UserRepository implements IUserRepository
{
    public function save(User $user): User
    {
        $model = UserAdapter::toEloquent($user);
        $model->save();
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
      public function existsByEmail(string $email): bool
    {
        return EloquentUser::where('email', $email)->exists();
    }
 public function findByUsername(string $username): ?User
{
    $model = EloquentUser::where('username', $username)
        ->where('status', 1)
        ->first();

    return $model ? UserAdapter::toEntity($model) : null;
}

}
