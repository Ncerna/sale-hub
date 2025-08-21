<?php
namespace Application\DTO;

class ProductDTO1
{
    public string $id;
    public string $name;
    public string $code;
    public float $unit_price;
    public float $igv_rate;
    public string $igv_affectation_code;
    public int $stock;
    public int $minimum_stock;

   /* public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->name = $data['name'];
        $this->code = $data['code'];
        $this->unit_price = $data['unit_price'];
        $this->igv_rate = $data['igv_rate'];
        $this->igv_affectation_code = $data['igv_affectation_code'];
        $this->stock = $data['stock'];
        $this->minimum_stock = $data['minimum_stock'];
    }*/
    public function __construct(string $id, string $name, string $code, float $priceWithIGV, int $stock)
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->priceWithIGV = $priceWithIGV;
        $this->stock = $stock;
    }
    
    public function getId(): string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getCode(): string {
        return $this->code;
    }

    public function getUnitPrice(): float {
        return $this->unit_price;
    }

    public function getIgvRate(): float {
        return $this->igv_rate;
    }

    public function getIgvAffectationCode(): string {
        return $this->igv_affectation_code;
    }

    public function getStock(): int {
        return $this->stock;
    }

    public function getMinimumStock(): int {
        return $this->minimum_stock;
    }

    // Setters
    public function setId(string $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setCode(string $code): void {
        $this->code = $code;
    }

    public function setUnitPrice(float $unit_price): void {
        $this->unit_price = $unit_price;
    }

    public function setIgvRate(float $igv_rate): void {
        $this->igv_rate = $igv_rate;
    }

    public function setIgvAffectationCode(string $code): void {
        $this->igv_affectation_code = $code;
    }

    public function setStock(int $stock): void {
        $this->stock = $stock;
    }

    public function setMinimumStock(int $minimum_stock): void {
        $this->minimum_stock = $minimum_stock;
    }
}
