<?php
namespace Application\DTO;

class ProductDTO
{
    public string $id;
    public string $name;
    public string $code;
    public ?string $barcode;
    public ?string $description;
    public float $unitPrice;
    public ?float $offerPrice;
    public float $igvRate;
    public string $igvAffectationCode;
    public int $stock;
    public int $minimumStock;
    public ?string $photo;
    public ?int $productTypeId;
    public ?int $providerId;
    public ?int $unitsMeasureId;
    public int $status;
    public ?int $companyId;
    public ?int $branchId;
    public ?int $warehouseId;
    /** @var array */
    public array $attributes;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->name = $data['name'];
        $this->code = $data['code'];
        $this->barcode = $data['barcode'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->unitPrice = $data['unitPrice'];
        $this->offerPrice = $data['offerPrice'] ?? null;
        $this->igvRate = $data['igvRate'];
        $this->igvAffectationCode = $data['igvAffectationCode'];
        $this->stock = $data['stock'];
        $this->minimumStock = $data['minimumStock'];
        $this->photo = $data['photo'] ?? null;
        $this->productTypeId = $data['productTypeId'] ?? null;
        $this->providerId = $data['providerId'] ?? null;
        $this->unitsMeasureId = $data['unitsMeasureId'] ?? null;
        $this->status = $data['status'] ?? 1;
        $this->companyId = $data['companyId'] ?? null;
        $this->branchId = $data['branchId'] ?? null;
        $this->warehouseId = $data['warehouseId'] ?? null;
        $this->attributes = $data['attributes'] ?? [];
    }
}
