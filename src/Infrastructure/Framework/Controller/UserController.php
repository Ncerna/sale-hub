<?php
namespace Infrastructure\Framework\Controller;
use Illuminate\Http\Request;
use Application\Contracts\UserServiceInterface;
use Infrastructure\Framework\Adapters\ApiResponse;

class UserController
{
    private UserServiceInterface $service;
    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }
    public function store(Request $request)
    {
        $user = $this->service->registerUser($request->all());
        return ApiResponse::success($user->toArray(), 'User registered successfully');
    }

    public function update(Request $request, int $id)
    {
        $user = $this->service->updateUser($request->all(), $id);
        return ApiResponse::success($user->toArray(), 'User update successfully');
    }
    public function destroy(int $id)
    {
        $response = $this->service->destroyUser($id);
        return ApiResponse::success([], 'User delete ' . ($response ? 'successfully' : 'failed'));
    }

    public function show(int $id)
    {
        return $this->service->getUser($id)->toArray();
    }

    public function list(Request $request)
    {
        
        $products = $this->service->listUsers( $request);
        return ApiResponse::success($products);
    }

}
