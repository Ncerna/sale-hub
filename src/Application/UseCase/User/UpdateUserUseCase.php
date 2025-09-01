<?php
namespace Application\UseCase\User;
use Domain\IService\IUserValidationService;
use Application\DTOs\UserRequest;
use Domain\Entity\User;
use Domain\ValueObject\Password;
use Domain\IRepository\IUserRepository;
class UpdateUserUseCase
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
        if ($user->getId()) {
            $userBD = $this->userRepo->findById($user->getId());
            $this->handlePasswordForUpdate($user,$userBD);
            $this->handlePhotoForUpdate($user,$userBD);
        }
        return $this->userRepo->save($user);
        
    }
    private function handlePasswordForUpdate(User $user, User $userBD): void
    {
        if (empty($user->getPassword())) {
            $user->setPassword($userBD->getPassword());
        } else {
            $password_hash = Password::fromPlainText($user->getPassword());
           $user->setPassword($password_hash->getHash());
        }
    }

    private function handlePhotoForUpdate(User $user, User $userBD): void
    {
        if (empty($user->getPhoneNumber())) {
            $user->setPhoneNumber($userBD->getPhoneNumber());
        } else {
            // lógica para subir y asignar nueva foto
        }
    }
}
