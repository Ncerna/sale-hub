<?php
namespace Domain\ValueObject;

class Money
{
    private float $amount;
    private string $currency;

    public function __construct(float $amount, string $currency = 'PEN')
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException("El monto no puede ser negativo.");
        }
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function add(Money $other): Money
    {
        if ($this->currency !== $other->getCurrency()) {
            throw new \InvalidArgumentException("No se pueden sumar diferentes monedas.");
        }

        return new Money($this->amount + $other->getAmount(), $this->currency);
    }

    // Otros métodos como subtract, multiply, format, etc.
}
