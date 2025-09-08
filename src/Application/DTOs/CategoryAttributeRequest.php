<?php
namespace Application\DTOs;

class CategoryAttributeRequest
{
    public ?int $id;
    public int $category_id;
    public string $name;
    public string $data_type;
    public bool $required;
    public int $status;
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
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getCategoryId(): int
    {
        return $this->category_id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getDataType(): string
    {
        return $this->data_type;
    }
    public function isRequired(): bool
    {
        return $this->required;
    }
    public function getStatus(): int
    {
        return $this->status;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function setDataType(string $data_type): void
    {
        $this->data_type = $data_type;
    }
    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}