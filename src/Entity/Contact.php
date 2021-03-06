<?php
namespace App\Entity;

use App\Entity\Gite;
use Symfony\Component\Validator\Constraints as Assert;


class Contact {

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *          min = 3, max = 30
     * )
     * 
     */
    private string $firstname;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *          min = 3, max = 30
     * )
     */
    private string $lastname;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *          min = 10,
     *          max = 10,
     *          exactMessage="Le numero doit comporter exactement {{ limit }} numéro."
     * )
     */
    private string $phone;

    /**
     * @Assert\NotBlank
     * @Assert\Email(
     *          message= "Cette e-mail {{ value }} n'est pas valide !"
     * )
     */
    private string $mail;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *          min = 5, max = 500
     * )
     */
    private string $message;

    private Gite $gite;
    

    /**
     * Get min = 3, max = 30
     */ 
    public function getFirstname() : string
    {
        return $this->firstname;
    }

    /**
     * Set min = 3, max = 30
     *
     * @return  self
     */ 
    public function setFirstname(string $firstname) :self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get min = 3, max = 30
     */ 
    public function getLastname() : string
    {
        return $this->lastname;
    }

    /**
     * Set min = 3, max = 30
     *
     * @return  self
     */ 
    public function setLastname(string $lastname) :self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get min = 10, max = 10
     */ 
    public function getPhone() : string
    {
        return $this->phone;
    }

    /**
     * Set min = 10, max = 10
     *
     * @return  self
     */ 
    public function setPhone(string $phone) :self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get message= "Cette e-mail {{ value }} n'est pas valide !
     */ 
    public function getMail() : string
    {
        return $this->mail;
    }

    /**
     * Set message= "Cette e-mail {{ value }} n'est pas valide !
     *
     * @return  self
     */ 
    public function setMail(string $mail) :self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get min = 5, max = 500
     */ 
    public function getMessage() : string
    {
        return $this->message;
    }

    /**
     * Set min = 5, max = 500
     *
     * @return  self
     */ 
    public function setMessage(string $message) :self
    {
        $this->message = $message;

        return $this;
    }


    /**
     * Get the value of gite
     */ 
    public function getGite() : Gite
    {
        return $this->gite;
    }

    /**
     * Set the value of gite
     *
     * @return  self
     */ 
    public function setGite(Gite $gite)
    {
        $this->gite = $gite;

        return $this;
    }
}