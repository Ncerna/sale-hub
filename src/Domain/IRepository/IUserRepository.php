<?php
namespace Domain\IRepository;

use Domain\Entity\User;
use Domain\ValueObject\Username;

interface IUserRepository {
    public function save(User $user): User;
    public function update(User $user): User;
    public function delete(string $id): void;
    public function findById(string $id): ?User;
    public function findAll(): array;
     public function existsByEmail(string $email): bool; 
     public function findByUsername(Username $username): ?User;
}
