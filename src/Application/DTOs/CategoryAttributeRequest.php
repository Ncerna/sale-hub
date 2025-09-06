<?php
namespace Application\DTOs;

class CategoryAttributeRequest
{
    private ?int $id;
    private int $category_id;
    private string $name;
    private string $data_type;
    private bool $required;
    private int $status;
    public static function fromArray(array $data): self {
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
}