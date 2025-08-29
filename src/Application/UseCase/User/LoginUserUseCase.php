<?php
namespace Application\UseCase\User;
use Tymon\JWTAuth\Facades\JWTAuth;
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

    public function execute(Username $username, string $password): User|array
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
        $token = JWTAuth::fromUser($user); // Para esto user debe ser compatible

        return [
            'user' => $user,
            'token' => $token,
        ];

        //return $user;
    }
}
