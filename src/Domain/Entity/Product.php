<?php
namespace Domain\Entity;

use  Domain\ValueObject\Price;
use  Domain\Entity\ProductAttribute;
use  Domain\ValueObject\IGVRate;
use  Domain\ValueObject\IGVAffectationCode;


class Product
{
    private ?int $id = null;
    private string $name;
    private string $code;
    private ?string $barcode;
    private ?string $description;
    private ?int $unit_price;
    private ?Int $igv_rate;
    private ?String $igv_affectation_code;
    private int $stock;
    private int $minimum_stock;
    private ?string $photo;
    private ?int $product_type_id;
    private ?int $provider_id;
    private ?int $units_measure_id;
    private int $status;
    private ?int $company_id;
    private ?int $branch_id;
    private ?int $warehouse_id;

    /** @var ProductAttribute[] */
    private array $product_attributes = [];

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

    public function getUnitPrice(): ?int { return $this->unit_price; }
    public function setUnitPrice(?int $unit_price): void { $this->unit_price = $unit_price; }

   
    public function getIgvRate(): ?int { return $this->igv_rate; }
    public function setIgvRate(?int $igv_rate): void { $this->igv_rate = $igv_rate; }

    public function getIgvAffectationCode(): ?string {
        return $this->igv_affectation_code;
    }
    
    public function setIgvAffectationCode(string $igv_affectation_code): void {
        $this->igv_affectation_code = $igv_affectation_code;
    }
    

    public function getStock(): int { return $this->stock; }
    public function setStock(int $stock): void { $this->stock = $stock; }

    public function getMinimumStock(): int { return $this->minimum_stock; }
    public function setMinimumStock(int $minimum_stock): void { $this->minimum_stock = $minimum_stock; }

    public function getPhoto(): ?string { return $this->photo; }
    public function setPhoto(?string $photo): void { $this->photo = $photo; }

    public function getProductTypeId(): ?int { return $this->product_type_id; }
    public function setProductTypeId(?int $product_type_id): void { $this->product_type_id = $product_type_id; }

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
    public function getProductAttributes(): array { return $this->product_attributes; }

    /**
     * @param ProductAttribute[] $product_attributes
     */
    public function setProductAttributes(array $product_attributes): void {
        $this->product_attributes = $product_attributes;
    }

    public function addProductAttribute(ProductAttribute $attribute): void {
        $this->product_attributes[] = $attribute;
    }


    private static array $valueObjectsMap = [
        'unit_price' => Price::class,
        'offer_price' => Price::class,
        'igv_rate' => IGVRate::class,
        'igv_affectation_code' => IGVAffectationCode::class,
    ];

}

