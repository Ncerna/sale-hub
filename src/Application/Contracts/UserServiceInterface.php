<?php
namespace Application\Contracts;
use Illuminate\Http\Request;
use Domain\Entity\User;

interface UserServiceInterface {
    public function registerUser(array $data): User;
    public function updateUser(array $data, int $id): User;
    public function destroyUser(int $id): bool;
    public function getUser(int $id): ?User;
    public function listUsers(Request $request): array;
    
}
