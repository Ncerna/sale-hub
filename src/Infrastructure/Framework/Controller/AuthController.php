<?php
namespace Infrastructure\Framework\Controller;
use Application\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController 
{
     private UserServiceInterface $service;

    public function __construct(UserServiceInterface $service) {
        $this->service = $service;
    }
    public function login(Request $request)
    {
        // Validar datos
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
        try {
            // Intenta refrescar el token actual. Necesita que el token no esté expirado más allá del refresh_ttl
            $newToken = JWTAuth::refresh(JWTAuth::getToken());

            // Devuelve el nuevo token al cliente
            return response()->json([
                'token' => $newToken,
            ]);
        } catch (JWTException $e) {
            // Si ocurre error (token no válido o expirado más allá del refresh_ttl)
            return response()->json(['error' => 'No se pudo refrescar el token'], 401);
        }
    }
}
