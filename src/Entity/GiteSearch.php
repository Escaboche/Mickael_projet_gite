<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class GiteSearch {

    /**
     * @var int|null $minSurface Surface minimum
     *@Assert\Range(
     *      min = 60,
     *      max = 400,
     *      notInRangeMessage = "La surface doit se trouver entre {{ min }} m² et  {{ max }} m²",
     * )
     */
    private $minSurface;

     /**
     * @var int|null $maxBedrooms nombre de chambre maximum
     *@Assert\Range(
     *      min = 2,
     *      minMessage = "Il ne peut y avoir mois de  {{ limit }} chambres",
     * )
     */
    private $maxBedrooms;
    
    /**
     * @var int|null $maxPrice prix maximum
     *@Assert\Range(
     *      min = 80000,
     *      max = 450000,
     *      notInRangeMessage = "Le prix minimum est de {{ min }} et maximum de {{ max }}",
     * )
     */
    private $maxPrice;


    /**
     * Get $minSurface Surface minimum
     *
     * @return  int|null
     */ 
    public function getMinSurface()
    {
        return $this->minSurface;
    }

    /**
     * Set $minSurface Surface minimum
     *
     * @param  int|null  $minSurface  $minSurface Surface minimum
     *
     * @return  self
     */ 
    public function setMinSurface($minSurface)
    {
        $this->minSurface = $minSurface;

        return $this;
    }

    /**
     * Get $maxBedrooms nombre de chambre maximum
     *
     * @return  int|null
     */ 
    public function getMaxBedrooms()
    {
        return $this->maxBedrooms;
    }

    /**
     * Set $maxBedrooms nombre de chambre maximum
     *
     * @param  int|null  $maxBedrooms  $maxBedrooms nombre de chambre maximum
     *
     * @return  self
     */ 
    public function setMaxBedrooms($maxBedrooms)
    {
        $this->maxBedrooms = $maxBedrooms;

        return $this;
    }

    /**
     * Get $maxPrice prix maximum
     *
     * @return  int|null
     */ 
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * Set $maxPrice prix maximum
     *
     * @param  int|null  $maxPrice  $maxPrice prix maximum
     *
     * @return  self
     */ 
    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }
}