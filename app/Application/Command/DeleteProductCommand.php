<?php
namespace Application\Command;

class DeleteProductCommand
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
