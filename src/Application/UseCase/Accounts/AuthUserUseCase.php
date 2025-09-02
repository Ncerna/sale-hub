<?php
namespace Application\UseCase\User\Accounts;
use Tymon\JWTAuth\Facades\JWTAuth;
use Domain\IRepository\IUserRepository;
use Domain\Entity\User;
use Domain\ValueObject\Username;
use Carbon\Carbon;

class AuthUserUseCase
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
          // Expiración en 7 días, por ejemplo
    $token = JWTAuth::factory()
        ->setTTL(60 * 24 * 7) // minutos en 7 días
        ->fromUser($user);
        return [
            'user' => $user,
            'token' => $token,
        ];

        //return $user;
    }
    
}
