<?php
namespace Domain\Entity;

class ProductAttribute
{
    private ?int $id=null;
    private int $product_id;
    private int $attribute_id;
    private string $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }

    public function getAttributeId(): int
    {
        return $this->attribute_id;
    }

    public function setAttributeId(int $attribute_id): void
    {
        $this->attribute_id = $attribute_id;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }
    public static function fromArray(array $data): self
{
    $instance = new self();
    foreach ($data as $key => $value) {
        $method = 'set' . str_replace('_', '', ucwords($key, '_'));
        if (method_exists($instance, $method)) {
            $instance->$method($value);
        }
    }
    return $instance;
}

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
