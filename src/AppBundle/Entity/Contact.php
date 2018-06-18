<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact", indexes={@ORM\Index(name="fk_contact_phone_type_idx", columns={"phone_type"}), @ORM\Index(name="idx_last_name_desc", columns={"last_name"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=45, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=45, nullable=true)
     */
    private $firstName;

    /**
     * @var \AppBundle\Entity\PhoneType
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PhoneType")
     * @ORM\JoinColumn(name="phone_type", referencedColumnName="id")
     *
     */
    private $phoneType;

    /**
     * @var integer
     *
     * @ORM\Column(type="phone_number")
     */
    private $number;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Contact
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Contact
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return PhoneType
     */
    public function getPhoneType()
    {
        return $this->phoneType;
    }

    /**
     * @param PhoneType $phoneType
     * @return Contact
     */
    public function setPhoneType($phoneType)
    {
        $this->phoneType = $phoneType;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return Contact
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }


}

