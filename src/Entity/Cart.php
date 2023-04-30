<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $basketTotal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBasketTotal(): ?float
    {
        return $this->basketTotal;
    }

    public function setBasketTotal(float $basketTotal): self
    {
        $this->basketTotal = $basketTotal;

        return $this;
    }
}
