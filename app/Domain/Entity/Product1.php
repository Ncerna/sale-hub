<?php
namespace Domain\Entity;

use Domain\ValueObject\IGVRate;
use Domain\ValueObject\Price;
use Domain\ValueObject\IGVAffectationCode;

class Product1
{
    private string $id;
    private string $name;
    private string $code;
    private ?string $barcode;
    private ?string $description;
    private ?Price $offer_price = null;

    private int $stock;
    private int $minimum_stock;
    private ?string $photo;
    private ?int $category_id;
    private ?string $unit_id;
    private int $status;
    private ?int $company_id;
    private ?int $branch_id;
    private ?int $warehouse_id;
    private \DateTime $created_at;
    private \DateTime $updated_at;

    private IGVRate $igv_rate;
    private Price $unit_price;
    private IGVAffectationCode $igv_affectation_code;

    public function __construct(
        string $id,
        string $name,
        string $code,
        Price $unit_price,
        IGVRate $igv_rate,
        IGVAffectationCode $igv_affectation_code,
        int $stock,
        int $minimum_stock,
        ?string $barcode = null,
        ?string $description = null,
        ?string $photo = null,
        ?int $category_id = null,
        ?string $unit_id = null,
        int $status = 1,
        ?int $company_id = null,
        ?int $branch_id = null,
        ?int $warehouse_id = null,
        ?Price $offer_price = null,

    ) {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->unit_price = $unit_price;
        $this->igv_rate = $igv_rate;
        $this->igv_affectation_code = $igv_affectation_code;
        $this->stock = $stock;
        $this->minimum_stock = $minimum_stock;
        $this->barcode = $barcode;
        $this->description = $description;
        $this->photo = $photo;
        $this->category_id = $category_id;
        $this->unit_id = $unit_id;
        $this->status = $status;
        $this->company_id = $company_id;
        $this->branch_id = $branch_id;
        $this->warehouse_id = $warehouse_id;
        $this->offer_price = $offer_price;

        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();

        $this->validate();
    }

    private function validate(): void
    {
        if (empty($this->name)) {
            throw new \InvalidArgumentException("El nombre del producto es obligatorio.");
        }
        if ($this->stock < 0) {
            throw new \InvalidArgumentException("El stock no puede ser negativo.");
        }
    }

    public function updateStock(int $quantity): void
    {
        $newStock = $this->stock + $quantity;
        if ($newStock < 0) {
            throw new \InvalidArgumentException("Stock insuficiente.");
        }
        $this->stock = $newStock;
        $this->updated_at = new \DateTime();
    }

    public function isStockBelowMinimum(): bool
    {
        return $this->stock < $this->minimum_stock;
    }

    public function getPriceWithIGV(): float
    {
        return $this->unit_price->getPriceWithIGV();
    }
    public function getStockValue(): float
    {
        return $this->stock * $this->unit_price->getBasePrice();
    }
    


    // ===== Setters =====

    public function setName(string $name): void { $this->name = $name; }
    public function setCode(string $code): void { $this->code = $code; }
    public function setUnitPrice(Price $unitPrice): void { $this->unit_price = $unitPrice; }
    public function setIgvRate(IGVRate $igvRate): void { $this->igv_rate = $igvRate; }
    public function setIgvAffectationCode(IGVAffectationCode $igvAffectationCode): void { $this->igv_affectation_code = $igvAffectationCode; }
    public function setStock(int $stock): void { $this->stock = $stock; }
    public function setMinimumStock(int $minimumStock): void { $this->minimum_stock = $minimumStock; }
    public function setUpdatedAt(\DateTime $updatedAt): void { $this->updated_at = $updatedAt; }

    public function setBarcode(?string $barcode): void { $this->barcode = $barcode; }
    public function setDescription(?string $description): void { $this->description = $description; }
    public function setPhoto(?string $photo): void { $this->photo = $photo; }
    public function setCategoryId(?int $categoryId): void { $this->category_id = $categoryId; }
    public function setUnitId(?string $unitId): void { $this->unit_id = $unitId; }
    public function setStatus(int $status): void { $this->status = $status; }
    public function setCompanyId(?int $companyId): void { $this->company_id = $companyId; }
    public function setBranchId(?int $branchId): void { $this->branch_id = $branchId; }
    public function setWarehouseId(?int $warehouseId): void { $this->warehouse_id = $warehouseId; }

    // ===== Getters =====

    public function getId(): string { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getCode(): string { return $this->code; }
    public function getUnitPrice(): Price { return $this->unit_price; }
    public function getIgvRate(): IGVRate { return $this->igv_rate; }
    public function getIgvAffectationCode(): IGVAffectationCode { return $this->igv_affectation_code; }
    public function getStock(): int { return $this->stock; }
    public function getMinimumStock(): int { return $this->minimum_stock; }
    public function getUpdatedAt(): \DateTime { return $this->updated_at; }
    public function getCreatedAt(): \DateTime { return $this->created_at; }

    public function getBarcode(): ?string { return $this->barcode; }
    public function getDescription(): ?string { return $this->description; }
    public function getPhoto(): ?string { return $this->photo; }
    public function getCategoryId(): ?int { return $this->category_id; }
    public function getUnitId(): ?string { return $this->unit_id; }
    public function getStatus(): int { return $this->status; }
    public function getCompanyId(): ?int { return $this->company_id; }
    public function getBranchId(): ?int { return $this->branch_id; }
    public function getWarehouseId(): ?int { return $this->warehouse_id; }

    public function getOfferPrice(): ?Price
{
    return $this->offer_price;
}

public function setOfferPrice(?Price $offerPrice): void
{
    $this->offer_price = $offerPrice;
}

}

