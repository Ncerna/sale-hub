<?php

namespace Domain\ValueObject;

use InvalidArgumentException;

class Price
{
    private float $amount;

    public function __construct(float $amount)
    {
        if ($amount < 0) {
            throw new InvalidArgumentException("El precio no puede ser negativo.");
        }

        $this->amount = round($amount, 2); // redondea a 2 decimales
    }

    public function value(): float
    {
        return $this->amount;
    }

    public function addTax(float $taxRate): Price
    {
        $taxedAmount = $this->amount * (1 + $taxRate);
        return new Price($taxedAmount);
    }

    public function subtract(Price $other): Price
    {
        return new Price($this->amount - $other->value());
    }

    public function add(Price $other): Price
    {
        return new Price($this->amount + $other->value());
    }

    public function equals(Price $other): bool
    {
        return $this->amount === $other->value();
    }

    public function __toString(): string
    {
        return number_format($this->amount, 2, '.', '');
    }
}
