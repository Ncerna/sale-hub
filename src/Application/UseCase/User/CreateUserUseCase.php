<?php
namespace Application\UseCase\User;
use Domain\IService\IUserValidationService;
use Application\DTOs\UserRequest;
use Domain\Entity\User;
use Domain\ValueObject\Password;
use Domain\IRepository\IUserRepository;
class CreateUserUseCase
{
    private IUserRepository $userRepo;
    private IUserValidationService $validation;
    public function __construct(IUserRepository $userRepo, IUserValidationService $validationService)
    {
        $this->userRepo = $userRepo;
        $this->validation = $validationService;
    }
    public function execute(UserRequest $UserRequest): User
    {
        $user = User::fromArray($UserRequest->toArray());
        $this->validation->validate($user);
        $password_hash = Password::fromPlainText($user->getPassword());
        $user->setPassword($password_hash->getHash());
        return $this->userRepo->save($user);
    }

}
