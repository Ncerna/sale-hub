<?php
namespace Domain\Entity;

class Role {
    private ?int $id= null;
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
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

}

