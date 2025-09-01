<?php
namespace Infrastructure\Framework\Adapters;
use Illuminate\Http\JsonResponse;
class ApiResponse  
{
    private function jsonResponse(array $payload,int $statusCode):JsonResponse
    {
        return response()->json($payload,$statusCode);
    }
    public static function success($data, $message = 'Success', $code = 200)
    {
        return response()->json([  'status' => true,  'code' => $code, 'message' => $message, 'data' => $data ], $code);
    }
    public function error(string $message,int $statusCode=400,$errors=null):JsonResponse
    {
        return $this->jsonResponse(['success'=>false,'message'=>$message,'errors'=>$errors],$statusCode);
    }
    
}