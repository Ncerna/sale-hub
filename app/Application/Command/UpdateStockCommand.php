<?php

namespace App\Application\Product\Command;

class UpdateStockCommand {
    private string $productName;
    private int $quantity;

    public function __construct(string $productName, int $quantity) {
        $this->productName = $productName;
        $this->quantity = $quantity;
    }

    public function getProductName(): string {
        return $this->productName;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }
}
