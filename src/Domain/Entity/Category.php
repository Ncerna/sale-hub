<?php
namespace Domain\Entity;

use Domain\Entity\CategoryAttribute;

class Category
{
    private ?int $id;
    private int $family_id;
    private string $name;
    private ?string $photo;
    private ?string $description;
    private int $status;
    /** @var CategoryAttribute[] */
    private array $attributes;

    public function __construct(?int $id, int $familyId, string $name, ?string $photo, ?string $description, int $status = 1, array $attributes = [])
    {
        $this->id = $id;
        $this->familyId = $familyId;
        $this->name = $name;
        $this->photo = $photo;
        $this->description = $description;
        $this->status = $status;
        $this->attributes = $attributes;
    }

    // getters y métodos para actualizar propiedades y para atributos
    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): void {
        $this->id = $id;
    }
    
    public function getFamilyId(): int { return $this->family_id; }
    public function getName(): string { return $this->name; }
    public function getPhoto(): ?string { return $this->photo; }
    public function getDescription(): ?string { return $this->description; }
    public function getStatus(): int { return $this->status; }
    /** @return CategoryAttribute[] */
    public function getAttributes(): array { return $this->attributes; }

    public function addAttribute(CategoryAttribute $attribute): void
    {
        $this->attributes[] = $attribute;
    }

    public function setFamilyId(int $family_id): void {
        $this->family_id = $family_id;
    }
    
    public function setName(string $name): void {
        $this->name = $name;
    }
    
    public function setPhoto(?string $photo): void {
        $this->photo = $photo;
    }
    
    public function setDescription(?string $description): void {
        $this->description = $description;
    }
    
    public function setStatus(int $status): void {
        $this->status = $status;
    }
    
    /**
     * @param CategoryAttribute[] $attributes
     */
    public function setAttributes(array $attributes): void {
        $this->attributes = $attributes;
    }
    
    // más métodos según necesidad...
}
