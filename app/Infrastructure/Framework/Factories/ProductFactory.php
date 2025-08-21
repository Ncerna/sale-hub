<? namespace Infrastructure\Framework\Factories;

use Domain\Entity\Product1;
use Domain\ValueObject\Price;
use Domain\ValueObject\IGVRate;
use Domain\ValueObject\IGVAffectationCode;

class ProductFactory
{
    public static function create(
        string $id,
        string $name,
        string $code,
        float $unitPrice,
        float $igvRate,
        string $igvCode,
        int $stock,
        int $minimumStock
    ): Product1 {
        return new Product1(
            $id,
            $name,
            $code,
            new Price($unitPrice, new IGVRate($igvRate)),
            new IGVRate($igvRate),
            new IGVAffectationCode($igvCode),
            $stock,
            $minimumStock
        );
    }
}
