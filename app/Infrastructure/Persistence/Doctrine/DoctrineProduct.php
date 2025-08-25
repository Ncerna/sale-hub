<?php

namespace App\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class DoctrineProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /** @ORM\Column(type="string", length=100) */
    private string $name;

    /** @ORM\Column(type="string", length=50, unique=true) */
    private string $code;

    /** @ORM\Column(type="decimal", scale=2) */
    private float $unitPrice;

    // Puedes tener relaciones con atributos
    /**
     * @ORM\OneToMany(targetEntity="DoctrineProductAttribute", mappedBy="product", cascade={"persist", "remove"})
     */
   

   
}
