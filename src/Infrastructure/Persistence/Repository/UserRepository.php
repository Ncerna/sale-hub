<?php
namespace Infrastructure\Persistence\Repository;
use Domain\Entity\User;
use Domain\IRepository\IUserRepository;
use Infrastructure\Persistence\Eloquent\EloquentUser;
use Infrastructure\Framework\Adapters\UserAdapter;
class UserRepository implements IUserRepository
{
    protected $model;

    public function __construct(EloquentUser $model)
    {
        $this->model = $model;
    }
    public function save(User $user): User
    {
        if ($user->getId()) {
            $model = EloquentUser::find($user->getId());
            $model = UserAdapter::toEloquent($user, $model);
        } else {
            $model = UserAdapter::toEloquent($user);
        }
        $model->save();
        if (!$user->getId()) {
            $reflection = new \ReflectionClass($user);
            $property = $reflection->getProperty('id');
            $property->setAccessible(true);
            $property->setValue($user, $model->id);
        }
        return $user;
    }

 

    public function delete(string $id): void
    {
        // Delete
    }

    public function findById(string $id): ?User
    {
        $model = EloquentUser::find($id);
        return $model ? UserAdapter::toDomain($model) : null;
    }


    public function findAll(): array
    {

        return [];
    }
    public function findByEmail(string $email): ?User
    {
        $model = EloquentUser::where('email', (string) $email)
            ->where('status', 1)
            ->first();
        return $model ? UserAdapter::toDomain($model) : null;
    }

    public function findByUsername(string $username): ?User
    {
        $model = EloquentUser::where('username', (string) $username)
            ->where('status', 1)
            ->first();
        return $model ? UserAdapter::toDomain($model) : null;
    }



}
