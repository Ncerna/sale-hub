<?php
namespace Application\UseCase\User;

use Domain\Entity\User;
use Domain\IRepository\IUserRepository;
use Exception;
class CreateUserUseCase {
    private IUserRepository $userRepo;

    public function __construct(IUserRepository $repo) {
        $this->userRepo = $repo;
    }

    public function execute(User $user): User {
         if ($this->userRepo->existsByEmail($user->getEmail())) {
            throw new Exception("Email already in use");
        }
        return $this->userRepo->save($user);
    }
}
