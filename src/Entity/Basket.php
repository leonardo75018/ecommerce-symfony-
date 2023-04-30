<?php

namespace App\Entity;

use App\Repository\BasketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BasketRepository::class)]
class Basket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'basket', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'baskets')]
    private Collection $productList;

    #[ORM\Column]
    private ?float $basketTotal = null;




    public function __construct()
    {
        $this->created_at = new  \DateTime();
        $this->productList = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProductList(): Collection
    {
        return $this->productList;
    }

    public function addProductList(Product $productList): self
    {
        if (!$this->productList->contains($productList)) {
            $this->productList->add($productList);
        }

        return $this;
    }

    public function removeProductList(Product $productList): self
    {
        $this->productList->removeElement($productList);

        return $this;
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
