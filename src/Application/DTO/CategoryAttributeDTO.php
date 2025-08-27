<?php
namespace Application\DTO;

class CategoryAttributeDTO
{
    public ?int $id;
    public int $categoryId;
    public string $name;
    public string $dataType;
    public bool $required;
    public int $status;

    public function __construct(?int $id, int $categoryId, string $name, string $dataType, bool $required, int $status)
    {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->dataType = $dataType;
        $this->required = $required;
        $this->status = $status;
    }
}
