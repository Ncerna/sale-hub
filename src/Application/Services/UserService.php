<?php
namespace Application\Services;
use Application\DTOs\UserRequest;
use Application\DTOs\RequestQuery;
use Illuminate\Http\Request;
use Application\Contracts\UserServiceInterface;
use Application\Contracts\FileManagerInterface;
use Application\UseCase\User\CreateUserUseCase;
use Application\UseCase\User\UpdateUserUseCase;
use Application\UseCase\user\DeleteUserUseCase;
use Application\UseCase\user\GetUserUseCase;
use Application\UseCase\user\ListUsersUseCase;
use Domain\Entity\User;

class UserService implements UserServiceInterface {
    private CreateUserUseCase $create;
    private UpdateUserUseCase $update;
    private FileManagerInterface $fileManager;
    private DeleteUserUseCase $delete;
    private GetUserUseCase $get;
    private ListUsersUseCase $list;

    public function __construct(
        CreateUserUseCase $create,
        UpdateUserUseCase $update,
        DeleteUserUseCase $delete,
        GetUserUseCase $get,
        ListUsersUseCase $list
    ) {
        $this->create = $create;
        $this->update = $update;
        $this->delete = $delete;
        $this->get = $get;
        $this->list = $list;
    }

    public function registerUser(array $data): User {
        $userRequest = UserRequest::fromArray($data);
        $userRequest->setId(null);
        $user = $this->create->execute($userRequest);
        if (!empty($data['images'])) {
            $this->fileManager->uploadFiles($user->getId(), $data['images']);
        }
        return $user;
    }

    public function updateUser(array $data,int $id): User {
        $userRequest = UserRequest::fromArray($data);
         $userRequest->setId($id);
         if (!empty($data['images_to_delete'])) {
            $this->fileManager->deleteFiles($$userRequest->getId(), $data['images_to_delete']);
        }
        return $this->update->execute($userRequest);
        
    }
    public function destroyUser(int $id): bool {
       return $this->delete->execute($id);
    }

    public function getUser(int $id): ?User {
        return $this->get->execute($id);

    }

    public function listUsers(Request $request): array {
        $queryDto = RequestQuery::fromRequest($request);
        return $this->list->execute($queryDto);
       
    }
    
}
