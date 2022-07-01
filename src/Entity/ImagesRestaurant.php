<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ImagesRestaurantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ImagesRestaurantRepository::class)]
#[ApiResource]
#[Vich\Uploadable]
class ImagesRestaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["resto:read"])]
    private $url;

    /**
     * @Vich\UploadableField(mapping="restaurant_images", fileNameProperty="url")
     * @var File
     */
    private $imageFile;

    #[ORM\ManyToOne(targetEntity: Restaurants::class, inversedBy: 'images')]
    private $restaurants;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return  'https://'.$_SERVER['SERVER_NAME'].'/uploads/'.$this->url;
       // return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

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

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            //  $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }
}
