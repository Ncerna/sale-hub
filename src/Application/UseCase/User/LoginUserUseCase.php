<?php
namespace Application\UseCase;

use Domain\IRepository\IUserRepository;
use Domain\Entity\User;
use Domain\ValueObject\Username;

class LoginUserUseCase
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(Username $username, string $password): User
    {
        $user = $this->userRepository->findByUsername($username);

        if (!$user) {
            throw new \InvalidArgumentException("Usuario no encontrado");
        }

        if (!$user->isActive()) {
            throw new \RuntimeException("Usuario inactivo");
        }

        if (!$user->validatePassword($password)) {
            throw new \InvalidArgumentException("Contraseña incorrecta");
        }

        return $user;
    }
}
