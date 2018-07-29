<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.05.18
 * Time: 18:07
 */

namespace ShopBundle\Controller;


use ShopBundle\Entity\CompareItem;
use ShopBundle\Entity\Product;
use Symfony\Component\Config\Definition\Exception\InvalidTypeException;

class CompareListController
{

    /**
     * @param $name
     * @param $specifications
     * @return int
     */
    static function searchNameInSpecifications($name, $specifications)
    {
        for ($i = 0; $i < count($specifications); $i++) {
            if (strval($specifications[$i]->getName()) == $name) {
                return $i;
            }
        }
        return -1;
    }

    /**
     * @param array $products
     * @return array
     */
    public static function generateCompareItemArray(array $products)
    {
        $result = [];

        if (count($products) == 0) {
            return $result;
        }

        for ($i = 0; $i < count($products); $i++) {
            if (!($products[$i] instanceof Product)) {
                throw new InvalidTypeException(sprintf('In the array of products №%d is of the wrong type', $i));
            }
        }

        $names = [];

        for ($i = 0; $i < count($products); $i++) {
            $specificationsYouAreLookingFor = $products[$i]->getProductSpecifications();

            for ($c = 0; $c < count($specificationsYouAreLookingFor); $c++) {
                $name = $specificationsYouAreLookingFor[$c]->getName();

                if (in_array($name, $names)) {
                    continue;
                }

                $names[] = $name;
                $item = new CompareItem($name);

                for ($j = 0; $j < count($products); $j++) {
                    if ($i == $j) {
                        $item->getValues()[] = $specificationsYouAreLookingFor[$c]->getValue();
                        continue;
                    }
                    $specificationsInWhichYouSearch = $products[$j]->getProductSpecifications();
                    $tmp = CompareListController::searchNameInSpecifications($name, $specificationsInWhichYouSearch);
                    if ($tmp >= 0) {
                        $item->getValues()[] = $specificationsInWhichYouSearch[$tmp]->getValue();
                        continue;
                    }
                    $item->getValues()[] = '-';
                }
                $result[] = $item;
            }

        }

        return $result;
    }

}