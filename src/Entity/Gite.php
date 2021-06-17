<?php

namespace App\Entity;

use App\Repository\GiteRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=GiteRepository::class)
 */
class Gite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

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
    private $name;

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
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message = "Ce champ est obligatoire")
     * @Assert\Range(
     *      min = 60,
     *      max = 400,
     *      notInRangeMessage = "La surface doit se trouver entre {{ min }} m² et  {{ max }} m²",
     * )
     */
    private $surface;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message = "Ce champ est obligatoire")
     * @Assert\Range(
     *      min = 2,
     *      max = 10,
     *      notInRangeMessage = "Il ne peut y avoir mois de  {{ min }} chambre",
     * )
     */
    private $bedrooms;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Ce champ est obligatoire")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Ce champ est obligatoire")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Ce champ est obligatoire")
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *      exactMessage = "La valeur doit etre exactement de 5 caractères"
     * )
     */
    private $postal_code;

    /**
     * @ORM\Column(type="boolean" ,options={"default":false})
     */
    private $animals;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToMany(targetEntity=Equipement::class, inversedBy="gites")
     */
    private $equipements;

    public function __construct()
    {
        $this->animals = false;
        $this->created_at = new DateTime();
        $this->equipements = new ArrayCollection();
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
}
