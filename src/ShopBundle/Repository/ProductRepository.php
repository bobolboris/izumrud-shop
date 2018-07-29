<?php

namespace ShopBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    /**
     * @param $limit
     * @param int $from
     * @return array
     */
    public function findAllByLimit($limit, $from = 0)
    {
        return $this->getEntityManager()->createQuery(sprintf("SELECT p FROM ShopBundle:Product p WHERE p.id > %d",
            $from))->setMaxResults($limit)->getResult();
    }

    /**
     * @param array $fields
     * @param bool $limit
     * @param bool $from
     * @return array
     */
    public function findByWithLimit(array $fields = [], $limit = false, $from = false)
    {
        $whereList = [];
        foreach ($fields as $key => $value) {
            $whereList[] = sprintf("p.%s = '%s'", $key, $value);
        }
        $where = '';

        $countMinusOne = count($whereList) - 1;
        for ($i = 0; $i < count($whereList); $i++) {
            $where .= $whereList[$i];
            if ($i < $countMinusOne) {
                $where .= ' AND ';
            }
        }

        if ($from != false) {
            $space = '';
            if (count($whereList) > 0) {
                $space = ' ';
            }
            $where .= ($where == '') ? "p.id > " . $from : $space . "AND p.id > " . $from;
        }

        $query = ($where == '') ? "SELECT p FROM ShopBundle:Product p" :
            "SELECT p FROM ShopBundle:Product p WHERE " . $where;
        $query = $this->getEntityManager()->createQuery($query);

        if ($limit != false) {
            $query->setMaxResults($limit);
        }
        return $query->getResult();
    }
}