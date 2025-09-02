<?php
namespace Infrastructure\Framework\Adapters;
use Domain\Entity\User;
use Infrastructure\Persistence\Eloquent\EloquentUser;
class UserAdapter
{
    public static function toEloquent(User $user, ?EloquentUser $eloquent = null): EloquentUser
    {
        $model = $eloquent ?? new EloquentUser();
        $model->fill([
            'id' => $user->getId(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'username' => $user->getUsername(),
            'password' => $user->getPassword(),
            'email' => $user->getEmail(),
            'phone_number' => $user->getPhoneNumber(),
            'address' => $user->getAddress(),
            'role_id' => $user->getRole()?->getId(),
            'status' => $user->getStatus(),
            'path_photo' => $user->getPathPhoto(),
            'path_qr' => $user->getPathQr(),
        ]);
        return $model;
    }
    public static function toDomain(EloquentUser $model): User
    {
        $data = $model->toArray();
        return User::fromArray($data);
    }
}
