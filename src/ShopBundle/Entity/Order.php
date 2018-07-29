<?php

namespace ShopBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="orders")
 */
class Order
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="OrderItem", mappedBy="order")
     */
    protected $products;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\ManyToOne(targetEntity="OrderStatuses", inversedBy="orders")
     */
    protected $status;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="orders")
     */
    protected $client;

    /**
     * Constructor
     * @param DateTime|null $dateTime
     */
    public function __construct(DateTime $dateTime = null)
    {
        $this->products = new ArrayCollection();
        $this->date = $dateTime;
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Order
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add product
     *
     * @param \ShopBundle\Entity\OrderItem $product
     *
     * @return Order
     */
    public function addProduct(OrderItem $product)
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setOrder($this);
        }
        return $this;
    }

    /**
     * Remove product
     *
     * @param \ShopBundle\Entity\OrderItem $product
     */
    public function removeProduct(OrderItem $product)
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            if ($product->getOrder() === $this) {
                $product->setOrder(null);
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
     * Set status
     *
     * @param \ShopBundle\Entity\OrderStatuses $status
     *
     * @return Order
     */
    public function setStatus(OrderStatuses $status = null)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return \ShopBundle\Entity\OrderStatuses
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set client
     *
     * @param \ShopBundle\Entity\Client $client
     *
     * @return Order
     */
    public function setClient(Client $client = null)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Get client
     *
     * @return \ShopBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }
}
