<?php
namespace App\Domain\Entity;

class ProductAttribute
{
    private int $attributeId;
    private string $value;

    public function __construct(int $attributeId, string $value)
    {
        $this->attributeId = $attributeId;
        $this->value = $value;
    }

    public function getAttributeId(): int
    {
        return $this->attributeId;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
