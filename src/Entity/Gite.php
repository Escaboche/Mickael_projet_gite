<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GiteRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;



/**
 * @ORM\Entity(repositoryClass=GiteRepository::class)
 * @Vich\Uploadable
 */
class Gite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Ce champ est obligatoire")
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Votre nom ne doit posséder minimum {{ limit }} caractères",
     *      maxMessage = "Votre nom ne doit pas depasser maximum {{ limit }} caractères"
     * )
     */
    private string $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message = "Ce champ est obligatoire")
     * @Assert\Length(
     *      min = 2,
     *      max = 150,
     *      minMessage = "La description doit posséder minimum {{ limit }} caractères",
     *      maxMessage = "La description ne doit pas depasser maximum {{ limit }} caractères"
     * )
     */
    private string $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message = "Ce champ est obligatoire")
     * @Assert\Range(
     *      min = 60,
     *      max = 400,
     *      notInRangeMessage = "La surface doit se trouver entre {{ min }} m² et  {{ max }} m²",
     * )
     */
    private int $surface;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message = "Ce champ est obligatoire")
     * @Assert\Range(
     *      min = 2,
     *      max = 10,
     *      notInRangeMessage = "Il ne peut y avoir mois de  {{ min }} chambre",
     * )
     */
    private int $bedrooms;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Ce champ est obligatoire")
     */
    private string $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Ce champ est obligatoire")
     */
    private string $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Ce champ est obligatoire")
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *      exactMessage = "La valeur doit etre exactement de 5 caractères"
     * )
     */
    private string $postal_code;

    /**
     * @ORM\Column(type="boolean" ,options={"default":false})
     */
    private bool $animals;

    /**
     * @ORM\Column(type="datetime")
     */
    private \Datetime $created_at;

    /**
     * @ORM\ManyToMany(targetEntity=Equipement::class, inversedBy="gites")
     */
    private Collection $equipements;

    /**
     * @ORM\ManyToMany(targetEntity=Service::class, inversedBy="gites")
     */
    private Collection $services;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message = "Ce champ est obligatoire")
     * @Assert\Range(
     *      min = 80000,
     *      max = 450000,
     *      notInRangeMessage = "Le prix minimum est de {{ min }} et maximum de {{ max }}",
     * )
     */
    private int $price;

    /**
     * @Vich\UploadableField(mapping="gite_image", fileNameProperty="imageName")
     * @Assert\Image(
     *         mimeTypes={"image/jpeg"}
     * 
     * )
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string",length=255)
     * 
     * @var string
     */
    private string $imageName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private \Datetime $updatedAt;

    /**
     * @ORM\Column(type="float")
     */
    private $lat;

    /**
     * @ORM\Column(type="float")
     */
    private $lng;

    public function __construct()
    {
        $this->animals = false;
        $this->created_at = new DateTime();
        $this->equipements = new ArrayCollection();
        $this->services = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getname(): ?string
    {
        return $this->name;
    }

    public function setname(string $name): self
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

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms): self
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getAnimals(): ?bool
    {
        return $this->animals;
    }

    public function setAnimals(bool $animals): self
    {
        $this->animals = $animals;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection|Equipement[]
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): self
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements[] = $equipement;
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): self
    {
        $this->equipements->removeElement($equipement);

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        $this->services->removeElement($service);

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

    /**
     * Get the value of imageFile
     *
     * @return  File|null
     */ 
    public function getImageFile() : ?File
    {
        return $this->imageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @param  File|null  $imageFile
     *
     * @return  property
     */ 
    public function setImageFile(?File $imageFile)
    {
        $this->imageFile = $imageFile;

        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * Get the value of imageName
     *
     * @return null|string
     */ 
    public function getImageName() : ?string
    {
        return $this->imageName;
    }

    /**
     * Set the value of imageName
     *
     * @param  string  $imageName
     *
     * @return  self
     */ 
    public function setImageName(string $imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get the value of updatedAt
     *
     * @return  \DateTime
     */ 
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @param  \DateTime  $updatedAt
     *
     * @return  self
     */ 
    public function setUpdatedAt(Datetime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    
    
}
