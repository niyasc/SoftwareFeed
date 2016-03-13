<?php

namespace SoftwareFeedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Software
 *
 * @ORM\Table(name="software")
 * @ORM\Entity(repositoryClass="SoftwareFeedBundle\Repository\SoftwareRepository")
 * @UniqueEntity("name", message="Software already exists!!")
 */
class Software
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

     /**
     * @ORM\ManyToOne(targetEntity="SoftwareType", inversedBy="softwarePackages")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $softwareType;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;


    /**
     * Get id
     *
     * @return int
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
     * @return Software
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Software
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Software
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set softwareType
     *
     * @param \stdClass $softwareType
     *
     * @return Software
     */
    public function setSoftwareType($softwareType)
    {
        $this->softwareType = $softwareType;

        return $this;
    }

    /**
     * Get softwareType
     *
     * @return \stdClass
     */
    public function getSoftwareType()
    {
        return $this->softwareType;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Software
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

	/**
     * @ORM\ManyToMany(targetEntity="Software", mappedBy="children")
     */
    private $parents;

    public function getParents() {
    	return $this -> parents;
    }

    public function setParents($parents) {
    	$this -> parents = $parents;
    	return $this;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Software", inversedBy="parents")
     * @ORM\JoinTable(name="software_children",
     *      joinColumns={@ORM\JoinColumn(name="child_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="parent_id", referencedColumnName="id")}
     * )
     */
    private $children;

	public function getChildren() {
		return $this -> children;
	}

	public function setChildren($children) {
		$this -> children = $children;
		return $this;
	}

	public function __toString() {
		return $this -> name;
	}
}

