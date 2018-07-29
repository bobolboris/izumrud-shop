<?php

namespace ShopBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="clients")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\ClientRepository")
 */
class Client
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $secondName;

    /**
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     */
    private $fatherName;

    /**
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="Order", mappedBy="client")
     */
    private $orders;

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
     * Set secondName
     *
     * @param string $secondName
     *
     * @return Client
     */
    public function setSecondName($secondName)
    {
        $this->secondName = $secondName;
        return $this;
    }

    /**
     * Get secondName
     *
     * @return string
     */
    public function getSecondName()
    {
        return $this->secondName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Client
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set fatherName
     *
     * @param string $fatherName
     *
     * @return Client
     */
    public function setFatherName($fatherName)
    {
        $this->fatherName = $fatherName;
        return $this;
    }

    /**
     * Get fatherName
     *
     * @return string
     */
    public function getFatherName()
    {
        return $this->fatherName;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Client
     */
    public function setBirthday(DateTime $birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set city
     *
     * @param \ShopBundle\Entity\City $city
     *
     * @return Client
     */
    public function setCity(City $city = null)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Get city
     *
     * @return \ShopBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    /**
     * Add order
     *
     * @param \ShopBundle\Entity\Order $order
     *
     * @return Client
     */
    public function addOrder(Order $order)
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setClient($this);
        }
        return $this;
    }

    /**
     * Remove order
     *
     * @param \ShopBundle\Entity\Order $order
     */
    public function removeOrder(Order $order)
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            if ($order->getClient() === $this) {
                $order->setClient(null);
            }
        }
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }

    function __toString()
    {
        return sprintf("%s %s %s", $this->getSecondName(), $this->getFirstName(), $this->getFatherName());
    }


}
