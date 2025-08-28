<?php
namespace Application\DTO;
use Domain\Entity\User;
class UserDTO
{
    public ?int $id = null;
    public string $first_name;
    public string $last_name;
    public string $username;
    public ?string $password = null;
    public string $email;
    public string $phone_number;
    public string $address;
    public int $role_id;
    public int $status;
    public string $path_photo;
    public string $path_qr;
    public static function fromArray(array $data): User
{
    $user = new User();

    foreach ($data as $key => $value) {
        $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));

        if (method_exists($user, $method)) {
            $user->$method($value);
        }
    }

    return $user;
}

}

