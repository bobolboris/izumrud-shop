<?php

namespace ShopBundle\Entity;


class CompareItem
{
    protected $name;
    protected $values;

    public function __construct(string $name = null, array $values = [])
    {
        $this->name = $name;
        $this->values = $values;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function &getValues()
    {
        return $this->values;
    }

    /**
     * @param array $values
     */
    public function setValues(array $values)
    {
        $this->values = $values;
    }
}