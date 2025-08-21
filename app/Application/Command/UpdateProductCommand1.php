<?php
namespace Application\Command;

class UpdateProductCommand1
{
    public string $id;
    public string $name;
    public string $code;
    public float $unit_price;
    public float $igv_rate;
    public string $igv_affectation_code;
    public int $stock;
    public int $minimum_stock;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->code = $data['code'];
        $this->unit_price = $data['unit_price'];
        $this->igv_rate = $data['igv_rate'];
        $this->igv_affectation_code = $data['igv_affectation_code'];
        $this->stock = $data['stock'];
        $this->minimum_stock = $data['minimum_stock'];
    }
}
