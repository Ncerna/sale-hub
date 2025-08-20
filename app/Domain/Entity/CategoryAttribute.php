<?php
namespace App\Domain\Entity;

class CategoryAttribute
{
    private ?int $id;
    private int $categoryId;
    private string $name;
    private string $dataType;
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
    public function getCategoryId(): int { return $this->categoryId; }
    public function getName(): string { return $this->name; }
    public function getDataType(): string { return $this->dataType; }
    public function isRequired(): bool { return $this->required; }
    public function getStatus(): int { return $this->status; }
}
