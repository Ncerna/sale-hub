<?php
namespace Application\Contracts;

use Domain\Entity\User;

interface UserServiceInterface {
    public function registerUser(array $data): User;
    public function updateUser(array $data): User;
    public function deleteUser(string $id): void;
    public function getUser(string $id): ?User;
    public function listUsers(): array;
    
}
