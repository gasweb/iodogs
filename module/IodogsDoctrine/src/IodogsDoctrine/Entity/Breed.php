<?php

namespace IodogsDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Breed
 *
 * @ORM\Table(name="breed")
 * @ORM\Entity
 */
class Breed
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
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=200, nullable=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="eng_title", type="string", length=100, nullable=true)
     */
    private $engTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="rus_title", type="string", length=100, nullable=true)
     */
    private $rusTitle;

    /**
     * @ORM\ManyToOne(targetEntity="InfoBlock")
     * @ORM\JoinColumn(name="info_block", referencedColumnName="id")
     */
    private $infoBlock;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", length=100, nullable=true)
     */
    private $fileName;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="IodogsDoctrine\Entity\Product", inversedBy="breed")
     * @ORM\JoinTable(name="product_breed",
     *   joinColumns={
     *     @ORM\JoinColumn(name="breed_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *   }
     * )
     * @ORM\OrderBy({"sortOrder" = "ASC"})
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
     * Set slug
     *
     * @param string $slug
     * @return Breed
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
     * Set engTitle
     *
     * @param string $engTitle
     * @return Breed
     */
    public function setEngTitle($engTitle)
    {
        $this->engTitle = $engTitle;

        return $this;
    }

    /**
     * Get engTitle
     *
     * @return string 
     */
    public function getEngTitle()
    {
        return $this->engTitle;
    }

    /**
     * Set rusTitle
     *
     * @param string $rusTitle
     * @return Breed
     */
    public function setRusTitle($rusTitle)
    {
        $this->rusTitle = $rusTitle;

        return $this;
    }

    /**
     * Get rusTitle
     *
     * @return string 
     */
    public function getRusTitle()
    {
        return $this->rusTitle;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     * @return Breed
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string 
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Add product
     *
     * @param \IodogsDoctrine\Entity\Product $product
     * @return Breed
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

    /**
     * Set infoBlock
     *
     * @param \IodogsDoctrine\Entity\InfoBlock $infoBlock
     * @return Breed
     */
    public function setInfoBlock(\IodogsDoctrine\Entity\InfoBlock $infoBlock = null)
    {
        $this->infoBlock = $infoBlock;

        return $this;
    }

    /**
     * Get infoBlock
     *
     * @return \IodogsDoctrine\Entity\InfoBlock 
     */
    public function getInfoBlock()
    {
        return $this->infoBlock;
    }
}
