<?php
namespace Domain\Entity;

class Role {
    private ?int $id= null;
    private string $name;

    public static function fromArray(array $data): self
{
    $instance = new self();
    foreach ($data as $key => $value) {
        $method = 'set' . str_replace('_', '', ucwords($key, '_'));
        if (method_exists($instance, $method)) {
            $instance->$method($value);
        }
    }
    return $instance;
}

    public function toArray(): array
    {
        return get_object_vars($this);
    }
   public function getId(): int {
    if ($this->id === null) {
        throw new \LogicException('Role ID has not been set');
    }
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

