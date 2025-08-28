<?php
namespace Application\Services;
use Application\DTO\UserDTO;
use Application\Contracts\UserServiceInterface;
use Application\UseCase\User\CreateUserUseCase;
/*use Application\UseCase\UpdateUserUseCase;
use Application\UseCase\DeleteUserUseCase;
use Application\UseCase\GetUserUseCase;
use Application\UseCase\ListUsersUseCase;*/
use Domain\Entity\User;

class UserApplicationService implements UserServiceInterface {
    private CreateUserUseCase $create;
    /*private UpdateUserUseCase $update;
    private DeleteUserUseCase $delete;
    private GetUserUseCase $get;
    private ListUsersUseCase $list;*/

    public function __construct(
        CreateUserUseCase $create,
       /* UpdateUserUseCase $update,
        DeleteUserUseCase $delete,
        GetUserUseCase $get,
        ListUsersUseCase $list*/
    ) {
        $this->create = $create;
        /*$this->update = $update;
        $this->delete = $delete;
        $this->get = $get;
        $this->list = $list;*/
    }

    public function registerUser(array $data): User {
         $user = UserDTO::fromArray($data);
        return $this->create->execute($user);
    }

    public function updateUser(array $data): User {
        $user = UserDTO::fromArray($data);
        //return $this->update->execute($user);
        return $user ;
    }

    public function deleteUser(string $id): void {
       // $this->delete->execute($id);
    }

    public function getUser(string $id): ?User {
       // return $this->get->execute($id);
    }

    public function listUsers(): array {
       // return $this->list->execute();
       return [];
    }
}
