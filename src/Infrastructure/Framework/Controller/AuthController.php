<?php
namespace Infrastructure\Framework\Controller;
use Application\Contracts\AuthServiceInterface;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController 
{
     private AuthServiceInterface $service;

    public function __construct(AuthServiceInterface $service) {
        $this->service = $service;
    }
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
       $result = $this->service->login($request->input('username'), $request->input('password'));
    return $this->respondWithToken($result['token']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60  // tiempo en segundos
        ]);
    }
    public function refresh(Request $request)
    {          
            $newToken = JWTAuth::refresh(JWTAuth::getToken());
            return response()->json([   'token' => $newToken, ]);
    }
}
