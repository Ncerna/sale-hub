<?php
namespace Application\Services;
use Application\Contracts\AuthServiceInterface;
use Application\UseCase\Accounts\AuthUserUseCase;


class AuthService implements AuthServiceInterface {

    private AuthUserUseCase $authUserUseCase;
    public function __construct( AuthUserUseCase $authUserUseCase ) {
        $this->authUserUseCase=$authUserUseCase;
    }
    public function login(String $username, string $password): array{
            
        return $this->authUserUseCase->execute($username,$password);
         }
}