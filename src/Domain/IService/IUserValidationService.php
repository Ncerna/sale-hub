<?php
namespace Domain\IService;

use Domain\Entity\User;

interface IUserValidationService {
    
    public function isEmailUnique(string $email, ?int $userId): bool;
    public function isUserNameUnique(string $userName, ?int $userId): bool;
    public function roleExists(int $roleId): bool;
    public function validate(User $user): void;
    public function userExists(int $userId): bool; 
}

