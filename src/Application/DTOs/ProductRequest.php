<?php

namespace Application\DTOs;

class ProductRequest
{
    public ?int $id = null;
    public string $name;
    public string $code;
    public ?string $barcode = null;
    public ?string $description = null;
    public float $unit_price; // Aquí sería conveniente usar un tipo primitivo para transporte
    public ?float $offer_price = null;
    public float $igv_rate;
    public string $igv_affectation_code;

    public int $stock;
    public int $minimum_stock;
    public ?string $photo = null;

    public ?int $product_type_id = null;
    public ?int $provider_id = null;
    public ?int $units_measure_id = null;

    public int $status;
    public ?int $company_id = null;
    public ?int $branch_id = null;
    public ?int $warehouse_id = null;

    /**
     * @var array
     */
    public array $attributes = [];

    public function getAttributes(): array { return $this->attributes; }

public function setAttributes(array $attributes): void { $this->attributes = $attributes; }

public function addAttribute(array $attribute): void {
    $this->attributes[] = $attribute;
}
public static function fromArray(array $data): self
{
    $instance = new self();
    foreach ($data as $key => $value) {
        $method = 'set' . str_replace('_', '', ucwords($key, '_'));
        if (method_exists($instance, $method)) {
            $instance->$method($value);
        }
    }
    return $instance;
}
public function toArray(): array
{
    return get_object_vars($this);
}
}