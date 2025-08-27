<?php
namespace Domain\ValueObject;

class IGVRate
{
    private float $rate; // Ejemplo: 0.18 para 18%

    public function __construct(float $rate)
    {
        if ($rate < 0 || $rate > 1) {
            throw new \InvalidArgumentException("Tasa de IGV inválida.");
        }
        $this->rate = $rate;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function calculateTax(float $amount): float
    {
        return $amount * $this->rate;
    }

    public function calculatePriceWithTax(float $amount): float
    {
        return $amount + $this->calculateTax($amount);
    }
}
