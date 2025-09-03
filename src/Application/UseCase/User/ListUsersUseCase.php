<?php
namespace Application\UseCase\User;
use Domain\IRepository\IUserRepository;
use Application\DTOs\RequestQuery;
class ListUsersUseCase
{
    private IUserRepository $userRepo;
    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function execute(RequestQuery $queryDto): array
    {
     return $this->userRepo->list($queryDto->page ,$queryDto->size,$queryDto->search);
    }
}