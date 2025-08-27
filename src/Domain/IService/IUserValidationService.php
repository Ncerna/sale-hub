<?php
namespace Domain\IService;

use Domain\Entity\User;

interface IUserValidationService {
    public function validate(User $user): void;
}
