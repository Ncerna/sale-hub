<?php
namespace Domain\Entity;

use Domain\Entity\CategoryAttribute;

class Category
{
    private ?int $id = null;
    private ?int $family_id;
    private string $name;
    private ?string $photo;
    private ?string $description;
    private int $status;
    /** @var CategoryAttribute[] */
    private array $attributes;

    public function __construct(?int $id, int $famil_id, string $name, ?string $photo, ?string $description, int $status = 1, array $attributes = [])
    {
        $this->id = $id;
        $this->family_id = $famil_id;
        $this->name = $name;
        $this->photo = $photo;
        $this->description = $description;
        $this->status = $status;
        $this->attributes = $attributes;
    }

    // getters y métodos para actualizar propiedades y para atributos
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getFamilyId(): ?int
    {
        return $this->family_id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getPhoto(): ?string
    {
        return $this->photo;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function getStatus(): int
    {
        return $this->status;
    }
    /** @return CategoryAttribute[] */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function addAttribute(CategoryAttribute $attribute): void
    {
        $this->attributes[] = $attribute;
    }
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function setFamilyId(int $family_id): void
    {
        $this->family_id = $family_id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPhoto(?string $photo): void
    {
        $this->photo = $photo;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
    public function fillFromArray(array $data): self
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        return $this;
    }
    public function removeAttribute(CategoryAttribute $attribute): void
    {
        foreach ($this->attributes as $key => $attr) {
            if ($attr->getId() === $attribute->getId()) {
                unset($this->attributes[$key]);
                // Reindexar el array para evitar huecos
                $this->attributes = array_values($this->attributes);
                break;
            }
        }
    }

    
}
