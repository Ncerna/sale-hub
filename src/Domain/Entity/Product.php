<?php
namespace Domain\Entity;

use  Domain\ValueObject\Price;
use  Domain\Entity\ProductAttribute;
use  Domain\ValueObject\IGVRate;
use  Domain\ValueObject\IGVAffectationCode;


class Product
{
    private ?int $id= null;
    private string $name;
    private string $code;
    private ?string $barcode;
    private ?string $description;
    private Price $unit_price;
    private ?Price $offer_price;
    private IGVRate $igv_rate;
    private IGVAffectationCode $igv_affectation_code;

    private int $stock;
    private ?int $minimum_stock=null;

    private ?string $photo;
    
    private ?int $product_type_id=null;
    private ?int $provider_id;
    private ?int $units_measure_id;
    
    private int $status;
    private ?int $company_id;
    private ?int $branch_id;
    private ?int $warehouse_id;

    /**
     * @var ProductAttribute[]
     */
    private array $attributes;
    // Getters y setters

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): void { $this->id = $id; }
    
    public function getName(): string { return $this->name; }
    public function setName(string $name): void { $this->name = $name; }
    
    public function getCode(): string { return $this->code; }
    public function setCode(string $code): void { $this->code = $code; }
    
    public function getBarcode(): ?string { return $this->barcode; }
    public function setBarcode(?string $barcode): void { $this->barcode = $barcode; }
    
    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): void { $this->description = $description; }
    
    public function getUnitPrice(): Price { return $this->unit_price; }
    public function setUnitPrice(Price $unit_price): void { $this->unit_price = $unit_price; }
    
    public function getOfferPrice(): ?Price { return $this->offer_price; }
    public function setOfferPrice(?Price $offer_price): void { $this->offer_price = $offer_price; }
    
    public function getIgvRate(): IGVRate { return $this->igv_rate; }
    public function setIgvRate(IGVRate $igv_rate): void { $this->igv_rate = $igv_rate; }
    
    public function getIgvAffectationCode(): IGVAffectationCode { return $this->igv_affectation_code; }
    public function setIgvAffectationCode(IGVAffectationCode $igv_affectation_code): void { $this->igv_affectation_code = $igv_affectation_code; }
    
    public function getStock(): int { return $this->stock; }
    public function setStock(int $stock): void { $this->stock = $stock; }
    
    public function getMinimumStock(): ?int { return $this->minimum_stock; }
    public function setMinimumStock(?int $minimum_stock): void { $this->minimum_stock = $minimum_stock; }
    public function getProductTypeId(): ?int { return $this->product_type_id; }
    public function setProductTypeId(?int $product_type_id): void { $this->product_type_id = $product_type_id; }
    
    public function getPhoto(): ?string { return $this->photo; }
    public function setPhoto(?string $photo): void { $this->photo = $photo; }
    
 
    public function getProviderId(): ?int { return $this->provider_id; }
    public function setProviderId(?int $provider_id): void { $this->provider_id = $provider_id; }
    
    public function getUnitsMeasureId(): ?int { return $this->units_measure_id; }
    public function setUnitsMeasureId(?int $units_measure_id): void { $this->units_measure_id = $units_measure_id; }
    
    public function getStatus(): int { return $this->status; }
    public function setStatus(int $status): void { $this->status = $status; }
    
    public function getCompanyId(): ?int { return $this->company_id; }
    public function setCompanyId(?int $company_id): void { $this->company_id = $company_id; }
    
    public function getBranchId(): ?int { return $this->branch_id; }
    public function setBranchId(?int $branch_id): void { $this->branch_id = $branch_id; }
    
    public function getWarehouseId(): ?int { return $this->warehouse_id; }
    public function setWarehouseId(?int $warehouse_id): void { $this->warehouse_id = $warehouse_id; }
    
    /**
     * @return ProductAttribute[]
     */
    public function getAttributes(): array { return $this->attributes; }
    
    public function setAttributes(array $attributes): void { $this->attributes = $attributes; }
    
    public function addAttribute(ProductAttribute $attribute): void {
        $this->attributes[] = $attribute;
    }
    

}

