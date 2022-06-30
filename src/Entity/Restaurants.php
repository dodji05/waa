<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RestaurantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantsRepository::class)]
#[ApiResource]
class Restaurants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nom;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $adresse;

    #[ORM\Column(type: 'float', nullable: true)]
    private $latitude;

    #[ORM\Column(type: 'float', nullable: true)]
    private $longitude;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $chef;

    #[ORM\OneToMany(mappedBy: 'restaurants', targetEntity: ImagesRestaurant::class)]
    private $images;

    #[ORM\OneToMany(mappedBy: 'restaurants', targetEntity: Menu::class)]
    private $plat;

    #[ORM\OneToMany(mappedBy: 'restaurants', targetEntity: AvisRestaurant::class)]
    private $avis;

    #[ORM\OneToMany(mappedBy: 'restaurants', targetEntity: Table::class)]
    private $tables;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->plat = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->tables = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getChef(): ?string
    {
        return $this->chef;
    }

    public function setChef(?string $chef): self
    {
        $this->chef = $chef;

        return $this;
    }

    /**
     * @return Collection<int, ImagesRestaurant>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(ImagesRestaurant $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setRestaurants($this);
        }

        return $this;
    }

    public function removeImage(ImagesRestaurant $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getRestaurants() === $this) {
                $image->setRestaurants(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getPlat(): Collection
    {
        return $this->plat;
    }

    public function addPlat(Menu $plat): self
    {
        if (!$this->plat->contains($plat)) {
            $this->plat[] = $plat;
            $plat->setRestaurants($this);
        }

        return $this;
    }

    public function removePlat(Menu $plat): self
    {
        if ($this->plat->removeElement($plat)) {
            // set the owning side to null (unless already changed)
            if ($plat->getRestaurants() === $this) {
                $plat->setRestaurants(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AvisRestaurant>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(AvisRestaurant $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setRestaurants($this);
        }

        return $this;
    }

    public function removeAvi(AvisRestaurant $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getRestaurants() === $this) {
                $avi->setRestaurants(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Table>
     */
    public function getTables(): Collection
    {
        return $this->tables;
    }

    public function addTable(Table $table): self
    {
        if (!$this->tables->contains($table)) {
            $this->tables[] = $table;
            $table->setRestaurants($this);
        }

        return $this;
    }

    public function removeTable(Table $table): self
    {
        if ($this->tables->removeElement($table)) {
            // set the owning side to null (unless already changed)
            if ($table->getRestaurants() === $this) {
                $table->setRestaurants(null);
            }
        }

        return $this;
    }
}
