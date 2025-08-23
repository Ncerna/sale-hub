<?php
// Application/Contracts/ProductServiceInterface.php

namespace Application\Contracts;

interface ProductServiceInterface
{
    public function registerProduct(array $data): void;

    public function updateProduct(string $id, array $data): void;

    public function deleteProduct(string $id): void;

    public function getProduct(string $id);
}
