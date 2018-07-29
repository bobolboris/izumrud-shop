<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\Product;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends BaseController
{

    /**
     * @param $data
     * @param int $size
     * @return array
     */
    protected function searchProduct($data, $size = -1)
    {
        $allProducts = $this->getDoctrine()->getRepository("ShopBundle:Product")->findAll();

        if ($size < 0) {
            $size = count($allProducts);
        }
        if (!isset($data)) {
            return [];
        }
        $arr = explode(' ', $data);
        $products = [];
        foreach ($allProducts as $item) {
            foreach ($arr as $temp) {
                $temp = mb_strtolower($temp);
                if (strrpos(mb_strtolower($item->getName()), $temp) != false ||
                    strrpos(mb_strtolower($item->getDescription()), $temp) != false
                ) {
                    $item->setCategory(null);
                    $item->setSubcategory(null);
                    $item->setProductSpecifications(null);
                    $products[] = $item;
                    break;
                }
            }
        }
        return array_slice($products, 0, $size);
    }

    public function searchAction($data)
    {
        $result = $this->baseLoad();
        $result['products'] = $this->searchProduct($data);
        $result['data'] = $data;
        return $this->render('ShopBundle:default:search.html.twig', $result);
    }

    public function searchAjaxAction(Request $request)
    {
        $arr = $this->searchProduct($request->get('data'), 10);
        $serializer = $this->container->get('serializer');
        return new JsonResponse([
            'ok' => true,
            'products' => $serializer->normalize($arr, null, array('enable_max_depth' => true))
        ]);
    }
}