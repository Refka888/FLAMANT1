<?php

namespace App\Entity;

use App\Entity\Traits\Timer;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
#[ORM\HasLifecycleCallbacks]

class Order
{
    use Timer;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getUsers","getOrders"])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(["getUsers", "getOrders"])]
    private ?int $code = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getUsers", "getOrders"])]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[Groups(["getUsers"])]
    private ?User $users = null;

    #[ORM\OneToMany(mappedBy: 'orders', targetEntity: Product::class)]
    private Collection $products;

    

    public function __construct()
    {
        $this->products = new ArrayCollection();
     

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setOrders($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getOrders() === $this) {
                $product->setOrders(null);
            }
        }

        return $this;
    }

   
}
