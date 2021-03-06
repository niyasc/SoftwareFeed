<?php 

namespace SoftwareFeedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * SoftwareType
 *
 * @ORM\Table(name="software_type")
 * @ORM\Entity(repositoryClass="SoftwareFeedBundle\Repository\SoftwareTypeRepository")
 * @UniqueEntity("name", message="Category already exists!!")
 */
class SoftwareType {
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;



    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SoftwareType
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return SoftwareType
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @ORM\ManyToOne(targetEntity="SoftwareType", inversedBy="subtypes")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    public function getParent() {
        return $this->parent;
    }

    public function setParent($parent) {
        $this->parent = $parent;
        return $this;
    }

    public function __toString() {
        return $this->name;
    }

    /**
     * @ORM\OneToMany(targetEntity="SoftwareType", mappedBy="parent")
     */
    private $subtypes;
	
	public function getSubtypes() {
		return $this -> subtypes;
	}
	
	public function setSubtypes($subtypes) {
		$this -> subtypes = $subtypes;
		return $this;
	}

	/**
	* @ORM\OneToMany(targetEntity="Software", mappedBy="softwareType")
	*/
	private $softwarePackages;

	public function getSoftwarePackages() {
		return $this -> softwarePackages;
	}

	public function setSoftwarePackages($softwarePackages) {
		$this -> softwarePackages = $softwarePackages;
		return $this;
	}

    public function __construct() {
        $this->subtypes = new ArrayCollection();
        $this->softwarePackages = new ArrayCollection();
    }
    
     /**
     * @var string
     * @ORM\Column(name="slug", type="string", length=255, nullable=false, unique=true)
     */
    private $slug;
    
    public function getSlug() {
        return $this -> slug;
    }
    
    public function setSlug($slug) {
        $this -> slug = $slug;
        return $this;
    }
}
