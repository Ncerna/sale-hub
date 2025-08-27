<?php
namespace Application\DTO;

class CategoryDTO
{
    public ?int $id;
    public int $familyId;
    public string $name;
    public ?string $photo;
    public ?string $description;
    public int $status;
    public array $attributes; // array de CategoryAttributeDTO

    public function __construct(?int $id, int $familyId, string $name, ?string $photo, ?string $description, int $status, array $attributes = [])
    {
        $this->id = $id;
        $this->familyId = $familyId;
        $this->name = $name;
        $this->photo = $photo;
        $this->description = $description;
        $this->status = $status;
        $this->attributes = $attributes;
    }
}
