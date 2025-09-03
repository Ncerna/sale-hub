<?php
namespace Domain\IRepository;

use Domain\Entity\User;


interface IUserRepository {
    public function save(User $user): User;
    public function delete(int $id): bool;
     public function disableUser(int $id): bool;
    public function findById(int $id): ?User;
     public function findByEmail(string $email): ?User;
     public function findByUsername(string $username): ?User;
     /**
     * @param int $page
     * @param int $size
     * @param string|null $search
     * @return User[]
     */
    public function list(int $page, int $size, ?string $search = null): array;
}
