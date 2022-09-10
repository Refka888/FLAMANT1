<?php

namespace App\Entity;

use App\Entity\Traits\Timer;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]

class Product
{
    use Timer;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getOrders", "getCats"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getOrders", "getCats"])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getOrders", "getCats"])]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getOrders", "getCats"])]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getOrders", "getCats"])]
    private ?string $quantity = null;

    #[ORM\Column]
    #[Groups(["getOrders", "getCats"])]
    private ?int $price = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[Groups(["getOrders", "getCats"])]
    private ?Order $orders = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["getCats"])]
    private ?Cat $cat = null;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getOrders(): ?Order
    {
        return $this->orders;
    }

    public function setOrders(?Order $orders): self
    {
        $this->orders = $orders;

        return $this;
    }

    public function getCat(): ?Cat
    {
        return $this->cat;
    }

    public function setCat(?Cat $cat): self
    {
        $this->cat = $cat;

        return $this;
    }

}
