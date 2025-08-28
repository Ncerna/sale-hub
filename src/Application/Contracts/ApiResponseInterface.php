<?php
namespace Application\Contracts;

interface ApiResponseInterface{
    public function success(string $message,$data=null,int $statusCode=200);
    public function paginated(string $message,$data,array $pagination,int $statusCode=200);
    public function error(string $message,int $statusCode=400,$errors=null);
}