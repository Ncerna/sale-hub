<?php
namespace Domain\ValueObject;
use Exception;
class Password
{
    private $password;
    private $min = 6;
    private $max = 20;

    public function __construct(string $password)
    {
        $length = mb_strlen($password);
        if ($length < $this->min || $length > $this->max) {
            throw new Exception("Password length must be between {$this->min} and {$this->max} characters.");
        }
        $this->password = $password;
    }

    public function getHashed(): string
    {
        return password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function verify(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->getHashed());
    }

    public function __toString()
    {
        return $this->password;
    }
}
