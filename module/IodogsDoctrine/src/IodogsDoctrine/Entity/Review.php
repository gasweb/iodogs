<?php

namespace IodogsDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Review
 *
 * @ORM\Table(name="review")
 * @ORM\Entity
 */
class Review
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \IodogsDoctrine\Entity\Breed
     *
     * @ORM\ManyToOne(targetEntity="IodogsDoctrine\Entity\Breed")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="breed", referencedColumnName="id")
     * })
     */
    private $breed;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=100, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="city_entered", type="string", length=100, nullable=true)
     */
    private $cityEntered;

    /**
     * @var integer
     *
     * @ORM\Column(name="region_city_id", type="integer", nullable=true)
     */
    private $regionCityId;

    /**
     * @var string
     *
     * @ORM\Column(name="review", type="text", length=65535, nullable=false)
     */
    private $review;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="add_date", type="datetime", nullable=false)
     */
    private $addDate;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="IodogsDoctrine\Entity\Product", inversedBy="review")
     * @ORM\JoinTable(name="review_product",
     *   joinColumns={
     *     @ORM\JoinColumn(name="review_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *   }
     * )
     */
    private $product;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->product = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Review
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
     * Set email
     *
     * @param string $email
     * @return Review
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Review
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set cityEntered
     *
     * @param string $cityEntered
     * @return Review
     */
    public function setCityEntered($cityEntered)
    {
        $this->cityEntered = $cityEntered;

        return $this;
    }

    /**
     * Get cityEntered
     *
     * @return string 
     */
    public function getCityEntered()
    {
        return $this->cityEntered;
    }

    /**
     * Set regionCityId
     *
     * @param integer $regionCityId
     * @return Review
     */
    public function setRegionCityId($regionCityId)
    {
        $this->regionCityId = $regionCityId;

        return $this;
    }

    /**
     * Get regionCityId
     *
     * @return integer 
     */
    public function getRegionCityId()
    {
        return $this->regionCityId;
    }

    /**
     * Set review
     *
     * @param string $review
     * @return Review
     */
    public function setReview($review)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return string 
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Review
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set addDate
     *
     * @param \DateTime $addDate
     * @return Review
     */
    public function setAddDate($addDate)
    {
        $this->addDate = $addDate;

        return $this;
    }

    /**
     * Get addDate
     *
     * @return \DateTime 
     */
    public function getAddDate()
    {
        return $this->addDate;
    }

    /**
     * Set breed
     *
     * @param \IodogsDoctrine\Entity\Breed $breed
     * @return Review
     */
    public function setBreed(\IodogsDoctrine\Entity\Breed $breed = null)
    {
        $this->breed = $breed;

        return $this;
    }

    /**
     * Get breed
     *
     * @return \IodogsDoctrine\Entity\Breed 
     */
    public function getBreed()
    {
        return $this->breed;
    }

    /**
     * Add product
     *
     * @param \IodogsDoctrine\Entity\Product $product
     * @return Review
     */
    public function addProduct(\IodogsDoctrine\Entity\Product $product)
    {
        $this->product[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \IodogsDoctrine\Entity\Product $product
     */
    public function removeProduct(\IodogsDoctrine\Entity\Product $product)
    {
        $this->product->removeElement($product);
    }

    /**
     * Get product
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
