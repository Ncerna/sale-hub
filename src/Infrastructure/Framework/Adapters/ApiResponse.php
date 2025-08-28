<?php
namespace Infrastructure\Framework\Adapters;
use Illuminate\Http\JsonResponse;
class ApiResponse implements ApiResponseInterface 
{
    private function jsonResponse(array $payload,int $statusCode):JsonResponse
    {
        return response()->json($payload,$statusCode);
    }
    public function success(string $message,$data=null,int $statusCode=200):JsonResponse
    {
        return $this->jsonResponse(['success'=>true,'message'=>$message,'data'=>$data],$statusCode);
    }
    public function error(string $message,int $statusCode=400,$errors=null):JsonResponse
    {
        return $this->jsonResponse(['success'=>false,'message'=>$message,'errors'=>$errors],$statusCode);
    }
    public function paginated(string $message,LengthAwarePaginator $paginator,int $statusCode=200):JsonResponse
    {
        return $this->jsonResponse(['success'=>true,'message'=>$message,'data'=>$paginator->items(),'pagination'=>['total'=>$paginator->total(),'per_page'=>$paginator->perPage(),'current_page'=>$paginator->currentPage(),'last_page'=>$paginator->lastPage()]],$statusCode);
    }
}