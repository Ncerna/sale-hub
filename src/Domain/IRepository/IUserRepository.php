<?php
namespace Domain\IRepository;

use Domain\Entity\User;

interface IUserRepository {
    public function save(User $user): User;
    public function update(User $user): User;
    public function delete(string $id): void;
    public function findById(string $id): ?User;
    public function findAll(): array;
}
