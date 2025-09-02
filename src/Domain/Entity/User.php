<?php
namespace Domain\Entity;
use Domain\Entity\Role;

class User {
    private ?int $id =null;
    private string $first_name;
    private string $last_name;
    private string $username;
    private ?string $password =null;
    private string $email;
    private string $phone_number;
    private string $address;
    private int $role_id;
    private Role $role;
    private int $status;
    private string $path_photo;
    private string $path_qr;

    public function toArray(): array {
        return get_object_vars($this);
    }

public static function fromArray(array $data): self {
    $instance = new self();

    foreach ($data as $key => $value) {
        if (property_exists($instance, $key)) {
            // Caso 1: Se estiver vindo o relacionamento 'role' como array
            if ($key === 'role' && is_array($value)) {
                $instance->role = Role::fromArray($value);
                continue;
            }

            // Caso 2: Se estiver vindo do frontend, só o ID (role_id)
            if ($key === 'role_id' && is_int($value)) {
                $instance->role_id = $value;
                continue;
            }

            $instance->$key = $value;
        }
    }

    return $instance;
}


    // Getters and Setters

    public function getId(): ?int {
        return $this->id;
    }
    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getFirstName(): string {
        return $this->first_name;
    }
    public function setFirstName(string $first_name): self {
        $this->first_name = $first_name;
        return $this;
    }

    public function getLastName(): string {
        return $this->last_name;
    }
    public function setLastName(string $last_name): self {
        $this->last_name = $last_name;
        return $this;
    }

    public function getUsername(): string {
        return $this->username;
    }
    public function setUsername(string $username): self {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): string {
        return $this->password;
    }
    public function setPassword(string $password): self {
        $this->password = $password;
        return $this;
    }

    public function getEmail(): string {
        return $this->email;
    }
    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    public function getPhoneNumber(): string {
        return $this->phone_number;
    }
    public function setPhoneNumber(string $phone_number): self {
        $this->phone_number = $phone_number;
        return $this;
    }

    public function getAddress(): string {
        return $this->address;
    }
    public function setAddress(string $address): self {
        $this->address = $address;
        return $this;
    }
    public function getRole(): Role {
        return $this->role;
    }
        public function setRole(Role $role): self {
        $this->role = $role;
        return $this;
        }


   /* public function getRole(): ?int {
        return $this->role_id;
    }
    public function setRole(?int $role_id): self {
        $this->role_id = $role_id;
        return $this;
    }*/

    public function getStatus(): int {
        return $this->status;
    }
    public function setStatus(int $status): self {
        $this->status = $status;
        return $this;
    }

    public function getPathPhoto(): string {
        return $this->path_photo;
    }
    public function setPathPhoto(string $path_photo): self {
        $this->path_photo = $path_photo;
        return $this;
    }

    public function getPathQr(): string {
        return $this->path_qr;
    }
    public function setPathQr(string $path_qr): self {
        $this->path_qr = $path_qr;
        return $this;
    }
    public function validatePassword(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->password);
    }

    public function isActive(): bool
    {
        return $this->status === 1;
    }

   
}
