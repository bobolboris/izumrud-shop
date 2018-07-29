<?php

namespace ShopBundle\Repository;


use Doctrine\ORM\EntityRepository;
use ShopBundle\Entity\Client;

class ClientRepository extends EntityRepository
{
    /**
     * @param Client $client
     * @return array
     */
    public function findCopy(Client $client)
    {
        $secondName = $client->getSecondName();
        $firstName = $client->getFirstName();
        $fatherName = $client->getFatherName();
        $birthday = $client->getBirthday();
        $city = $client->getCity();
        if (!isset($secondName) || !isset($firstName) || !isset($fatherName) || !isset($birthday) || !isset($city)) {
            return [];
        }
        $query =
            sprintf("SELECT p FROM ShopBundle:CLIENT p WHERE p.secondName = '%s' AND p.firstName = '%s' AND p.fatherName = '%s' AND p.birthday = '%s' AND p.city = '%d'",
                $secondName, $firstName, $fatherName, $birthday->format('Y-m-d'), $city->getId());
        return $this->getEntityManager()->createQuery($query)->getResult();
    }
}