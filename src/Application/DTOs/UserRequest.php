<?php
namespace Application\DTOs;
use Domain\Entity\Role;

class UserRequest
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
    public Role $role;
    public int $status;
    public string $path_photo;
    public string $path_qr;

    public static function fromArray(array $data): self
    {
        $required = ['first_name', 'last_name', 'username', 'password', 'role_id'];
        foreach ($required as $key) {
            if (!isset($data[$key])) {
                throw new \InvalidArgumentException("Falta el campo requerido: $key",400);
            }
        }
        $DTOs = new self();
        foreach ($data as $key => $value) {
            if (property_exists($DTOs, $key)) {
                if ($key === 'role_id') {
                 $role = new Role();
                 $role->setId($value);
                 $DTOs->setRole($role);
                }
                $DTOs->$key = $value;
            }
        }
        return $DTOs;
    }
    public function toArray(): array
    {
        return get_object_vars($this);
    }
       public function getRole(): Role {
        return $this->role;
    }
        public function setRole(Role $role): self {
        $this->role = $role;
        return $this;
        }
}


