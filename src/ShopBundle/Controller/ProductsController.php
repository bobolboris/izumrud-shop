<?php

namespace ShopBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductsController extends BaseController
{
    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function productsAction($id)
    {
        $em = $this->getDoctrine();
        $product = $em->getRepository("ShopBundle:Product")->find($id);
        if ($product == null) {
            throw new NotFoundHttpException();
        }

        $result = $this->baseLoad();
        $result['product'] = $product;
        $result['specification'] = $product->getProductSpecifications();
        $result['category'] = $product->getCategory();
        $result['subcategory'] = $product->getSubcategory();

        return $this->render('ShopBundle:default:product.html.twig', $result);
    }
}