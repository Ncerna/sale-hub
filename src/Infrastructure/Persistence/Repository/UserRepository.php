<?php
namespace Infrastructure\Persistence\Repository;
use Domain\Entity\User;
use Domain\IRepository\IUserRepository;
use Infrastructure\Persistence\Eloquent\EloquentUser;
use Infrastructure\Framework\Adapters\UserAdapter;
use Infrastructure\Framework\Adapters\ResponsePaginate;
use Infrastructure\Framework\Adapters\ModelMapper;
class UserRepository implements IUserRepository
{
    protected $model;
    public function __construct(EloquentUser $model)
    {
        $this->model = $model;
    }

    public function save(User $user): User
    {
        $model = $user->getId()
            ? EloquentUser::find($user->getId()) : new EloquentUser();
        $model = UserAdapter::toEloquent($user, $model);
        $model->save();
        if (!$user->getId()) {
            $user->setId($model->id);
        }
        return $user;
    }

    public function delete(int $id): bool
    {
        $model = EloquentUser::find($id);
        if (!$model) return false;
        return (bool) $model->delete();
    }

    public function disableUser(int $id): bool
    {
        $model = EloquentUser::find($id);
        if (!$model)  return false;
        $model->status = 0;
        return $model->save();
    }

      public function findById(int $id): ?User
      {
        // $model = EloquentUser::with('role')->find($id);
        $model = EloquentUser::find($id);
        if (!$model) {
            return null;
        }
        $model->setPassword=null;
       return $model ? UserAdapter::toDomain($model) : null;
    }

    public function list(int $page, int $size, ?string $search = null): array
    {
        $query = $this->model
            ->with([
                'roles' => function ($query) {
                    $query->select('roles.id', 'roles.name');
                }
            ])
            ->select('id', 'first_name', 'last_name', 'username', 'email')
            ->where('status', 1);
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }
        $paginator = $query->orderBy('id')->paginate($size, ['*'], 'page', $page);
        return ResponsePaginate::format($paginator);
        //return $paginator->toArray();
    }

    public function findAll(): array
    {
        $models = $this->model->with(['roles:id,name'])
            ->select('id', 'first_name', 'last_name', 'username', 'email')
            ->where('status', 1)
            ->orderBy('id')
            ->get();

        $result = [];

        foreach ($models as $model) {
            $result[] = ModelMapper::model_map($model->toArray(), User::class);
        }

        return $result;
    }

    public function findByEmail(string $email): ?User
    {
        $model = EloquentUser::where('email', (string) $email)
            ->where('status', 1)
            ->first();

        return $model ? ModelMapper::model_map($model, User::class) : null;
    }

    public function findByUsername(string $username): ?User
    {
        $model = EloquentUser::where('username', (string) $username)
            ->where('status', 1)
            ->first();

        return $model ? ModelMapper::model_map($model, User::class) : null;
    }
}

