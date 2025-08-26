<?php
namespace App\Domain\ValueObject;

class IGVAffectationCode
{
    private string $code;

    public function __construct(string $code)
    {
        $allowedCodes = ['10', '20', '30']; // Ejemplo de códigos válidos
        if (!in_array($code, $allowedCodes)) {
            throw new \InvalidArgumentException("Código de afectación IGV inválido.");
        }
        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
