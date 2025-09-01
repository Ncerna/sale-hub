<?php
namespace Infrastructure\ServiceImplementations;
use Domain\IRepository\IUserRepository;
use Domain\IRepository\IRoleRepository;
use Domain\IService\IUserValidationService;
use Domain\Entity\User;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Exception;

class UserValidationService implements IUserValidationService
{
    private IUserRepository $userRepo;
    private IRoleRepository $roleRepo;

    public function __construct(IUserRepository $userRepo, IRoleRepository $roleRepo) {
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
    }

   public function isEmailUnique(string $email, ?int $user_id): bool {
    $user = $this->userRepo->findByEmail($email);
    if ($user === null) {
        return true; // No existe nadie con ese email, por lo tanto es único
    }
    if ($user_id === null) {
        return false; // Está intentando crear, pero ya existe un usuario con ese email
    }
    return $user->getId() === $user_id; // Si está editando, devuelve true si es el mismo usuario
}


    public function isUserNameUnique(string $user_name, ?int $excludeUserId = null): bool {
     
        $existingUser = $this->userRepo->findByUsername($user_name);
        if ($existingUser === null)
            return true;
        if ($excludeUserId === null)
            return false;
        return (int) $existingUser->getId() === (int) $excludeUserId;
    
    }

    public function roleExists(int $roleId): bool {
        return $this->roleRepo->exists($roleId);
    }

    public function validate (User $user):void{
      if (!$this->isEmailUnique($user->getEmail(),$user->getId())) {
            throw new BadRequestHttpException("El usuario con email {$user->getEmail()} ya existe.");
        }
        if (!$this->isUserNameUnique($user->getUsername(), $user->getId())) {
            throw new BadRequestHttpException("El username {$user->getUsername()} ya está en uso.");
        }
        if (!$this->roleExists($user->getRole()->getId())) {
            throw new BadRequestHttpException("El rol especificado no existe.");
        }  
    }
}

