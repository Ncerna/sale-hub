<?php
namespace Infrastructure\Framework\Controller;
use Illuminate\Http\Request;
use Application\Contracts\UserServiceInterface;
use Infrastructure\Framework\Adapters\ApiResponse;

class UserController {
    private UserServiceInterface $service;

    public function __construct(UserServiceInterface $service) {
        $this->service = $service;
    }

    public function store(Request $request) {
      $user = $this->service->registerUser($request->all());
     return ApiResponse::success($user->toArray(), 'User registered successfully');
    }

    public function update(Request $request) {
        $user = $this->service->updateUser($request->all());
      return ApiResponse::success($user->toArray(), 'User update successfully');
    }

    public function delete(string $id) {
        $this->service->deleteUser($id);
    }

    public function get(string $id) {
        return $this->service->getUser($id);
    }

    public function list() {
        return $this->service->listUsers();
    }

}
