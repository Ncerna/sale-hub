<?php
namespace Domain\Entity;

class Role {
    private string $id;
    private string $name;

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

}

