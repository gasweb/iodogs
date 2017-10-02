<?php

namespace IodogsDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Line
 *
 * @ORM\Table(name="solution")
 * @ORM\Entity
 */
class Solution
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
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=200, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="img_path", type="string", length=200, nullable=true)
     */
    private $imgPath;


    /**
     * @ORM\ManyToOne(targetEntity="InfoBlock")
     * @ORM\JoinColumn(name="info_block", referencedColumnName="id")
     */
    private $infoBlock;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="IodogsDoctrine\Entity\Product", inversedBy="solution")
     * @ORM\JoinTable(name="product_solution",
     *   joinColumns={
     *     @ORM\JoinColumn(name="solution_id", referencedColumnName="id")
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
     * Set title
     *
     * @param string $title
     * @return Solution
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Solution
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
     * Set imgPath
     *
     * @param string $imgPath
     * @return Solution
     */
    public function setImgPath($imgPath)
    {
        $this->imgPath = $imgPath;

        return $this;
    }

    /**
     * Get imgPath
     *
     * @return string 
     */
    public function getImgPath()
    {
        return $this->imgPath;
    }

    /**
     * Set infoBlock
     *
     * @param \IodogsDoctrine\Entity\InfoBlock $infoBlock
     * @return Solution
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

    /**
     * Add product
     *
     * @param \IodogsDoctrine\Entity\Product $product
     * @return Solution
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
