<?php

namespace Domain\Entity;
use Domain\Entity\Role;

class User {
    private string $id;
    private string $first_name;
    private string $last_name;
    private string $username;
    private string $password;
    private string $email;
    private string $phone_number;
    private string $address;
    private Role $role;
    private int $status;
    private string $path_photo;
    private string $path_qr;

    // Constructor, getters y setters aquí
}
