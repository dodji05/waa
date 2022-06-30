<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AvisRestaurantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRestaurantRepository::class)]
#[ApiResource]
class AvisRestaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text', nullable: true)]
    private $Commentaires;

    #[ORM\Column(type: 'float', nullable: true)]
    private $note;

    #[ORM\ManyToOne(targetEntity: Restaurants::class, inversedBy: 'avis')]
    private $restaurants;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaires(): ?string
    {
        return $this->Commentaires;
    }

    public function setCommentaires(?string $Commentaires): self
    {
        $this->Commentaires = $Commentaires;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getRestaurants(): ?Restaurants
    {
        return $this->restaurants;
    }

    public function setRestaurants(?Restaurants $restaurants): self
    {
        $this->restaurants = $restaurants;

        return $this;
    }
}
