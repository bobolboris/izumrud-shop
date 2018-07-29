<?php

namespace ShopBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="orderitems")
 */
class OrderItem
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="products")
     */
    protected $order;

    /**
     * @ORM\ManyToOne(targetEntity="Product")
     */
    protected $product;

    /**
     * @ORM\Column(type="integer")
     */
    protected $count;

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
     * Set count
     *
     * @param integer $count
     *
     * @return OrderItem
     */
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set order
     *
     * @param \ShopBundle\Entity\Order $order
     *
     * @return OrderItem
     */
    public function setOrder(Order $order = null)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Get order
     *
     * @return \ShopBundle\Entity\Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set product
     *
     * @param \ShopBundle\Entity\Product $product
     *
     * @return OrderItem
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

    function __toString()
    {
        return sprintf("%s - %d", $this->getProduct()->__toString(), $this->getCount());
    }


}
