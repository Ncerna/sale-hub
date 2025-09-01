<?php
namespace Domain\IService;

use Domain\Entity\User;

interface IUserValidationService {
    
    public function isEmailUnique(String $email ,?int $user_id): bool;
    public function isUserNameUnique(String $user_Name,?int $user_id): bool;
     public function roleExists(int $role_id): bool;
     public function validate(User $user): void;
}
