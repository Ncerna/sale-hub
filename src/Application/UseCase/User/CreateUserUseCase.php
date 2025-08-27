<?php
namespace Application\UseCase\User;

use Domain\Entity\User;
use Domain\IRepository\IUserRepository;

class CreateUserUseCase {
    private IUserRepository $userRepo;

    public function __construct(IUserRepository $repo) {
        $this->userRepo = $repo;
    }

    public function execute(User $user): User {
        // Aquí puedes llamar a un validador si lo deseas
        return $this->userRepo->save($user);
    }
}
