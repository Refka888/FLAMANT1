<?php

namespace App\Entity;

use App\Entity\Traits\Timer;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CatRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CatRepository::class)]
#[ORM\HasLifecycleCallbacks]

class Cat
{
    use Timer;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getCats"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getCats"])]
    private ?string $name = null;

  
   

    public function __construct()
    {
    }

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

}
