<?php
namespace Application\DTO;

class ProductDTO
{
    public string $id;
    public string $name;
    public string $code;
    public ?string $barcode;
    public ?string $description;
    public float $unit_price;
    public ?float $offer_price;
    public float $igv_rate;
    public string $igv_affectation_code;
    public int $stock;
    public int $minimum_stock;
    public ?string $photo;
    public ?int $category_id;
    public ?string $unit_id;
    public ?int $provider_id;
    public int $status;
    public ?int $company_id;
    public ?int $branch_id;
    public ?int $warehouse_id;
    public ?string $created_at;
    public ?string $updated_at;

    /**
     * @var array
     * Formato: [ ['attribute_id' => int, 'value' => string], ... ]
     */
    public array $attributes;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->name = $data['name'];
        $this->code = $data['code'];
        $this->barcode = $data['barcode'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->unit_price = $data['unit_price'];
        $this->offer_price = $data['offer_price'] ?? null;
        $this->igv_rate = $data['igv_rate'];
        $this->igv_affectation_code = $data['igv_affectation_code'];
        $this->stock = $data['stock'];
        $this->minimum_stock = $data['minimum_stock'];
        $this->photo = $data['photo'] ?? null;
        $this->category_id = $data['category_id'] ?? null;
        $this->unit_id = $data['unit_id'] ?? null;
        $this->provider_id = $data['provider_id'] ?? null;
        $this->status = $data['status'] ?? 1;
        $this->company_id = $data['company_id'] ?? null;
        $this->branch_id = $data['branch_id'] ?? null;
        $this->warehouse_id = $data['warehouse_id'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at'] ?? null;
        $this->attributes = $data['attributes'] ?? [];
    }
}
