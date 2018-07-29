<?php

namespace ShopBundle\Controller;


use ShopBundle\Entity\Product;

class IndexController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $result = $this->baseLoad();
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository(Product::class)->findAllByLimit(4);
        $result['products'] = $products;
        return $this->render('ShopBundle:default:index.html.twig', $result);
    }
}