<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="blueprints")
 */
class Blueprint {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
	private $name;

    /**
     * @ORM\Column(type="integer")
     */
	private $groupSize;

    /**
     * @ORM\Column(type="string", length=2000, nullable=true)
     */
	private $roles;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Blueprint
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set groupSize
     *
     * @param integer $groupSize
     *
     * @return Blueprint
     */
    public function setGroupSize($groupSize)
    {
        $this->groupSize = $groupSize;

        return $this;
    }

    /**
     * Get groupSize
     *
     * @return integer
     */
    public function getGroupSize()
    {
        return $this->groupSize;
    }

    /**
     * Set roles
     *
     * @param string $roles
     *
     * @return Blueprint
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return string
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
