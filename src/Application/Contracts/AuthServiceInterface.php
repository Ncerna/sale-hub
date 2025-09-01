<?php
namespace Application\Contracts;


interface AuthServiceInterface {
   
    public function login(String $username, string $password): array;
}