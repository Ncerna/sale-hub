<?php
namespace Application\DTOs;

class CategoryRequest
{
    public ?int $id = null;
    public int $family_id;
    public string $name;
    public ?string $photo;
    public ?string $description;
    public int $status;
    public array $attributes;
    public static function fromArray(array $data): self
    {
        $instance = new self();
        foreach ($data as $key => $value) {
            if (property_exists($instance, $key)) {
                $instance->$key = $value;
            }
        }
        return $instance;
    }
    public function toArray(): array
    {
        return get_object_vars($this);
    }
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
}

