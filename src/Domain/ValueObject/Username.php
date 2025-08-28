<?php
namespace Domain\ValueObject;

final class Username
{
    private string $username;

    public function __construct(string $username)
    {
        if (!$this->validate($username)) {
            throw new \InvalidArgumentException("Username inválido");
        }
        $this->username = $username;
    }

    private function validate(string $username): bool
    {
        // Ejemplo: solo alfanumérico y entre 3 y 20 caracteres
        return preg_match('/^[a-zA-Z0-9]{3,20}$/', $username);
    }

    public function __toString(): string
    {
        return $this->username;
    }
}
