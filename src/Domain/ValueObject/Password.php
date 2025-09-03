<?php
namespace Domain\ValueObject;

use Exception;

class Password
{
    private string $hashedPassword;
    private int $min = 6;
    private int $max = 20;

    /**
     * Constructor privado para evitar crear instancia sin hash
     */
    private function __construct(string $hashedPassword)
    {
        $this->hashedPassword = $hashedPassword;
    }

    /**
     * Crear el objeto Password desde texto plano (validando y hasheando)
     */
    public static function fromPlainText(string $plainPassword): self
    {
        $length = mb_strlen($plainPassword);
        if ($length < 6 || $length > 20) {
            throw new Exception("Password length must be between 6 and 20 characters.");
        }

        $hash = password_hash($plainPassword, PASSWORD_BCRYPT);

        return new self($hash);
    }

    /**
     * Crear el objeto Password desde un hash (ejemplo al cargar de BD)
     */
    public static function fromHash(string $hash): self
    {
        return new self($hash);
    }

    /**
     * Verificar un texto plano contra el hash guardado
     */
    public function verify(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->hashedPassword);
    }

    /**
     * Obtener el hash (para almacenar)
     */
    public function getHash(): string
    {
        return $this->hashedPassword;
    }

   
    
}
