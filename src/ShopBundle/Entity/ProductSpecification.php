<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.10.17
 * Time: 18:37
 */

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="productspecification")
 */
class ProductSpecification
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="SpecificationNames")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $value;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productSpecifications")
     */
    protected $product;


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
     * Set value
     *
     * @param string $value
     *
     * @return ProductSpecification
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set name
     *
     * @param \ShopBundle\Entity\SpecificationNames $name
     *
     * @return ProductSpecification
     */
    public function setName(SpecificationNames $name = null)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return \ShopBundle\Entity\SpecificationNames
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set product
     *
     * @param \ShopBundle\Entity\Product $product
     *
     * @return ProductSpecification
     */
    public function setProduct(Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \ShopBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
