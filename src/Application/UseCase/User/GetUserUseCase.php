<?php
namespace Application\UseCase\User;
use Domain\IRepository\IUserRepository;
use Domain\Entity\User;
use Exception;
class GetUserUseCase
{
    private IUserRepository $userRepo;
    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function execute(int $id): ?User
    {
        if (empty($id))  throw new Exception("You must provide an identifier");
       return $this->userRepo->findById($id);
        
    }
}