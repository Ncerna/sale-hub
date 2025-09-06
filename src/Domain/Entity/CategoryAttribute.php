<?php
namespace Domain\Entity;

class CategoryAttribute
{
    private ?int $id;
    private int $category_id;
    private string $name;
    private string $data_type;
    private bool $required;
    private int $status;

    public function __construct(?int $id, int $categoryId, string $name, string $dataType, bool $required = false, int $status = 1)
    {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->dataType = $dataType;
        $this->required = $required;
        $this->status = $status;
    }

    // getters y setters
    public function getId(): ?int { return $this->id; }
    public function getCategoryId(): int { return $this->category_id; }
    public function setCategoryId(int $category_id): void { $this->category_id = $category_id; }
    public function getName(): string { return $this->name; }
    public function getDataType(): string { return $this->data_type; }
    public function isRequired(): bool { return $this->required; }
    public function getStatus(): int { return $this->status; }

    public function setId(?int $id): void {
        $this->id = $id;
    }
    
    public function setName(string $name): void {
        $this->name = $name;
    }
    
    public function setDataType(string $data_type): void {
        $this->data_type = $data_type;
    }
    
    public function setRequired(bool $required): void {
        $this->required = $required;
    }
    
    public function setStatus(int $status): void {
        $this->status = $status;
    }
    
}
