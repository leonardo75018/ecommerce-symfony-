<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 150)]
    private ?string $firstName = null;

    #[ORM\Column(length: 150)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Basket $basket = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ShippingAddress::class)]
    private Collection $shippingAddress;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: BillingAddress::class)]
    private Collection $billingAddress;





    public function __construct()
    {
        $this->created_at = new  \DateTime();
        $this->shippingAddress = new ArrayCollection();
        $this->billingAddress = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function getBasket(): ?Basket
    {
        return $this->basket;
    }

    public function setBasket(?Basket $basket): self
    {
        // unset the owning side of the relation if necessary
        if ($basket === null && $this->basket !== null) {
            $this->basket->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($basket !== null && $basket->getUser() !== $this) {
            $basket->setUser($this);
        }

        $this->basket = $basket;

        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }

    /**
     * @return Collection<int, ShippingAddress>
     */
    public function getShippingAddress(): Collection
    {
        return $this->shippingAddress;
    }

    public function addShippingAddress(ShippingAddress $shippingAddress): self
    {
        if (!$this->shippingAddress->contains($shippingAddress)) {
            $this->shippingAddress->add($shippingAddress);
            $shippingAddress->setUser($this);
        }

        return $this;
    }

    public function removeShippingAddress(ShippingAddress $shippingAddress): self
    {
        if ($this->shippingAddress->removeElement($shippingAddress)) {
            // set the owning side to null (unless already changed)
            if ($shippingAddress->getUser() === $this) {
                $shippingAddress->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BillingAddress>
     */
    public function getBillingAddress(): Collection
    {
        return $this->billingAddress;
    }

    public function addBillingAddress(BillingAddress $billingAddress): self
    {
        if (!$this->billingAddress->contains($billingAddress)) {
            $this->billingAddress->add($billingAddress);
            $billingAddress->setUser($this);
        }

        return $this;
    }

    public function removeBillingAddress(BillingAddress $billingAddress): self
    {
        if ($this->billingAddress->removeElement($billingAddress)) {
            // set the owning side to null (unless already changed)
            if ($billingAddress->getUser() === $this) {
                $billingAddress->setUser(null);
            }
        }

        return $this;
    }
}
