<?php
namespace Infrastructure\Framework\Controller;

use Illuminate\Http\Request;
use Application\Contracts\UserServiceInterface;

class UserController {
    private UserServiceInterface $service;

    public function __construct(UserServiceInterface $service) {
        $this->service = $service;
    }

    public function store(Request $request) {
        $hello="kkkk";
      $user = $this->service->registerUser($request->all());
    return response()->json([
        'status' => true,
        'user' => $user
    ]);
    }

    public function update(Request $request) {
        return $this->service->updateUser($request->all());
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
    public function login(Request $request)
    {
        $data= $request->all();
        return $this->service->login($data['username'], $data['password']);
       // return response()->json(ResponseFormatter::loginSuccess($result['user'], $result['token']));
    }
}
