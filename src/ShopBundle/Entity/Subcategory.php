<?php

namespace ShopBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="subcategories")
 */
class Subcategory
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $url = "";

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="subcategories")
     */
    protected $category;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="subcategory")
     */
    protected $products;

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
     * @return Subcategory
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
     * Set url
     *
     * @param string $url
     *
     * @return Subcategory
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set category
     *
     * @param \ShopBundle\Entity\Category $category
     *
     * @return Subcategory
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return \ShopBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * Add product
     *
     * @param \ShopBundle\Entity\Product $product
     *
     * @return Subcategory
     */
    public function addProduct(Product $product)
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setSubcategory($this);
        }
        return $this;
    }

    /**
     * Remove product
     *
     * @param \ShopBundle\Entity\Product $product
     */
    public function removeProduct(Product $product)
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            if ($product->getSubcategory() === $this) {
                $product->setSubcategory(null);
            }
        }
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Get name with category name
     *
     * @return string
     */
    public function getNameWithCategoryName()
    {
        $categoryName = ($this->getCategory() != null) ? strval($this->getCategory()) : '';
        return ($this->getName() != null) ? sprintf("%s - %s", $categoryName, $this->getName()) : '' . $categoryName;
    }

    function __toString()
    {
        return ($this->getName() != null) ? $this->getName() : '';
    }


}
