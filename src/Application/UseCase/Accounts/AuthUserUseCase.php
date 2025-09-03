<?php
namespace Application\UseCase\Accounts;
use Tymon\JWTAuth\Facades\JWTAuth;
use Domain\IRepository\IUserRepository;
use Domain\Entity\User;
use Carbon\Carbon;

class AuthUserUseCase
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(String $username, string $password): User|array
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
        $user->setPassword(null);
        return [ 'user' => $user, 'token' => JWTAuth::factory()->setTTL(60 * 24 * 7)->fromUser($user)];

    }
    
}
