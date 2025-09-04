<?php

namespace Application\DTOs;

class ProductRequest
{
    public ?int $id = null;
    public string $name;
    public string $code;
    public ?string $barcode = null;
    public ?string $description = null;
    public float $unit_price;
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

  
    public array $product_attributes = [];
}
