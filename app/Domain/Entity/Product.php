<?php
namespace App\Domain\Entity;

use Domain\ValueObject\Price;
use Domain\Entity\ProductAttribute;
use Domain\ValueObject\IGVRate;
use Domain\ValueObject\IGVAffectationCode;

class Product
{
    private string $id;
    private string $name;
    private string $code;
    private ?string $barcode;
    private ?string $description;
    private Price $unitPrice;
    private ?Price $offerPrice;
    private IGVRate $igvRate;
    private IGVAffectationCode $igvAffectationCode;

    private int $stock;
    private int $minimumStock;
    private ?string $photo;
    
    // Unificados y corregidos nombres para IDs relacionados
    private ?int $productTypeId;
    private ?int $providerId;
    private ?int $unitsMeasureId;
    
    private int $status;
    private ?int $companyId;
    private ?int $branchId;
    private ?int $warehouseId;

    /**
     * @var ProductAttribute[]
     */
    private array $attributes;


    public function __construct(
        string $id,
        string $name,
        string $code,
        ?string $barcode,
        ?string $description,
        Price $unitPrice,
        ?Price $offerPrice,
        IGVRate $igvRate,
        IGVAffectationCode $igvAffectationCode,
        int $stock,
        int $minimumStock,
        ?string $photo,
        ?int $productTypeId,
        ?int $providerId,
        ?int $unitsMeasureId,
        int $status,
        ?int $companyId,
        ?int $branchId,
        ?int $warehouseId,
        array $attributes = []
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->barcode = $barcode;
        $this->description = $description;
        $this->unitPrice = $unitPrice;
        $this->offerPrice = $offerPrice;
        $this->igvRate = $igvRate;
        $this->igvAffectationCode = $igvAffectationCode;
        $this->stock = $stock;
        $this->minimumStock = $minimumStock;
        $this->photo = $photo;
        $this->productTypeId = $productTypeId;
        $this->providerId = $providerId;
        $this->unitsMeasureId = $unitsMeasureId;
        $this->status = $status;
        $this->companyId = $companyId;
        $this->branchId = $branchId;
        $this->warehouseId = $warehouseId;
        $this->attributes = $attributes;
    }

    // Getters
    public function getId(): string { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getCode(): string { return $this->code; }
    public function getBarcode(): ?string { return $this->barcode; }
    public function getDescription(): ?string { return $this->description; }
    public function getUnitPrice(): Price { return $this->unitPrice; }
    public function getOfferPrice(): ?Price { return $this->offerPrice; }
    public function getIgvRate(): IGVRate { return $this->igvRate; }
    public function getIgvAffectationCode(): IGVAffectationCode { return $this->igvAffectationCode; }
    public function getStock(): int { return $this->stock; }
    public function getMinimumStock(): int { return $this->minimumStock; }
    public function getPhoto(): ?string { return $this->photo; }
    public function getProductTypeId(): ?int { return $this->productTypeId; }
    public function getProviderId(): ?int { return $this->providerId; }
    public function getUnitsMeasureId(): ?int { return $this->unitsMeasureId; }
    public function getStatus(): int { return $this->status; }
    public function getCompanyId(): ?int { return $this->companyId; }
    public function getBranchId(): ?int { return $this->branchId; }
    public function getWarehouseId(): ?int { return $this->warehouseId; }

    /**
     * @return ProductAttribute[]
     */
    public function getAttributes(): array { return $this->attributes; }

    public function addAttribute(ProductAttribute $attribute): void { $this->attributes[] = $attribute; }
    public function setAttributes(array $attributes): void { $this->attributes = $attributes; }

    // Métodos de negocio
    public function isStockBelowMinimum(): bool { return $this->stock < $this->minimumStock; }
    public function getPriceWithIGV(): float { return $this->unitPrice->getBasePrice() * (1 + $this->igvRate->getRate() / 100); }
    public function getStockValue(): float { return $this->stock * $this->unitPrice->getBasePrice(); }

    public function updateStock(int $quantity): void
    {
        if ($quantity < 0) throw new \InvalidArgumentException("Quantity must be positive");
        if ($quantity > $this->stock) throw new \DomainException("Not enough stock");
        $this->stock -= $quantity;
    }
}
