<?php
namespace Domain\IRepository;

use Domain\Entity\User;


interface IUserRepository {
    public function save(User $user): User;
    public function delete(string $id): bool;
    public function findById(string $id): ?User;
    public function findAll(): array;
     public function findByEmail(string $email): ?User;
     public function findByUsername(string $username): ?User;
}
