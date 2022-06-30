<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nom;

    #[ORM\Column(type: 'float', nullable: true)]
    private $prix;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descriptionPlat;

    #[ORM\ManyToOne(targetEntity: Restaurants::class, inversedBy: 'plat')]
    private $restaurants;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: ImagesMenu::class)]
    private $images;

    #[ORM\ManyToOne(targetEntity: CategorieMenu::class, inversedBy: 'menus')]
    private $categorie;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescriptionPlat(): ?string
    {
        return $this->descriptionPlat;
    }

    public function setDescriptionPlat(?string $descriptionPlat): self
    {
        $this->descriptionPlat = $descriptionPlat;

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

    /**
     * @return Collection<int, ImagesMenu>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(ImagesMenu $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setMenu($this);
        }

        return $this;
    }

    public function removeImage(ImagesMenu $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getMenu() === $this) {
                $image->setMenu(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?CategorieMenu
    {
        return $this->categorie;
    }

    public function setCategorie(?CategorieMenu $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
