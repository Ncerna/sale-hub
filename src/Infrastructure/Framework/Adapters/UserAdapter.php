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
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'username' => $user->getUsername(),
            'password' => $user->getPassword(), // Hash ya aplicado si corresponde
            'email' => $user->getEmail(),
            'phone_number' => $user->getPhoneNumber(),
            'address' => $user->getAddress(),
            'role' => $user->getRole(),
            'status' => $user->getStatus(),
            'path_photo' => $user->getPathPhoto(),
            'path_qr' => $user->getPathQr()
        ]);
        return $model;
    }
}
