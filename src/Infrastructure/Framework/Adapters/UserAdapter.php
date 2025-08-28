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
            'role_id' => $user->getRole() ? $user->getRole()->getId() : null,
            'status' => $user->getStatus(),
            'path_photo' => $user->getPathPhoto(),
            'path_qr' => $user->getPathQr()
        ]);
        return $model;
    }
    public static function toEntity(EloquentUser $model): User
    {
    $data = $model->toArray();
    return User::fromArray($data);
}
/*
 public static function toEloquent(User $user): EloquentUser
    {
        if ($user->getId()) {
            $model = EloquentUser::find($user->getId()) ?? new EloquentUser();
        } else {
            $model = new EloquentUser();
        }

        $model->first_name = $user->getFirstName();
        $model->last_name = $user->getLastName();
        $model->username = $user->getUsername();
        $model->password = $user->getPassword(); // Pasa el hash si usas Value Object Password
        $model->email = $user->getEmail();
        $model->phone_number = $user->getPhoneNumber();
        $model->address = $user->getAddress();
        $model->role_id = $user->getRole()->getId();
        $model->status = $user->getStatus();
        $model->path_photo = $user->getPathPhoto();
        $model->path_qr = $user->getPathQr();

        return $model;
    }

    public static function toEntity(EloquentUser $model): User
    {
        $user = new User();
        $user->setId($model->id);
        $user->setFirstName($model->first_name);
        $user->setLastName($model->last_name);
        $user->setUsername($model->username);
        $user->setPassword($model->password); // Con Value Object Password usar constructor o método correspondiente
        $user->setEmail($model->email);
        $user->setPhoneNumber($model->phone_number);
        $user->setAddress($model->address);

        // Ejemplo para Role (requiere RoleAdapter)
        if ($model->relationLoaded('role') && $model->role) {
            $user->setRole(RoleAdapter::toEntity($model->role));
        }

        $user->setStatus($model->status);
        $user->setPathPhoto($model->path_photo);
        $user->setPathQr($model->path_qr);

        return $user;
    }*/

}
