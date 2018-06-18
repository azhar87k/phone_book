<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PhoneType
 *
 * @ORM\Table(name="phone_type", uniqueConstraints={@ORM\UniqueConstraint(name="type_UNIQUE", columns={"type"})})
 * @ORM\Entity
 */
class PhoneType
{
    /**
     * Phone Types
     */
    const TYPE_HOME     = 'home';
    const TYPE_WORK     = 'work';
    const TYPE_CELLULAR = 'cellular';
    const TYPE_OTHER    = 'Other';

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
     * @ORM\Column(name="type", type="string", length=45, nullable=false)
     */
    private $type;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return PhoneType
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

