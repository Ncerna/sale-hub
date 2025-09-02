<?php
namespace Application\UseCase\User;
use Domain\IRepository\IUserRepository;
use Exception;
class DeleteUserUseCase
{
    private IUserRepository $userRepo;
    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function execute(int $id): bool
    {
        if (empty($id))  throw new Exception("You must provide an identifier");
        $user = $this->userRepo->findById($id);
        if (empty($user))  throw new Exception("User not found");
        try {
            return $this->userRepo->delete($id);
        } catch (Exception $e) {
            return $this->userRepo->disableUser($id);
        }
    }
}
