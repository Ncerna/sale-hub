<?php
namespace App\Domain\ValueObject;

class Price
{
    private float $basePrice;
    private IGVRate $igvRate;

    public function __construct(float $basePrice, IGVRate $igvRate)
    {
        if ($basePrice < 0) {
            throw new \InvalidArgumentException("El precio base no puede ser negativo.");
        }
        $this->basePrice = $basePrice;
        $this->igvRate = $igvRate;
    }

    public function getBasePrice(): float
    {
        return $this->basePrice;
    }

    public function getPriceWithIGV(): float
    {
        return $this->basePrice + $this->igvRate->calculateTax($this->basePrice);
    }

    public function getPriceWithoutIGV(): float
    {
        return $this->basePrice;
    }

    // Se puede agregar método para descuentos, ofertas, etc.
}
