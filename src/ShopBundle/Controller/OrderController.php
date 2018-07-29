<?php

namespace ShopBundle\Controller;


use DateTime;
use ShopBundle\Entity\Order;
use ShopBundle\Entity\OrderItem;
use ShopBundle\Entity\OrderStatuses;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addOrderAction(Request $request)
    {
        $products = $request->get('products');

        if (!isset($products)) {
            return new JsonResponse(['ok' => false]);
        }

        $productsRepository = $this->getDoctrine()->getRepository("ShopBundle:Product");

        $order = new Order(new DateTime("now"));
        $order->setStatus($this->getDoctrine()->getRepository("ShopBundle:OrderStatuses")->find(1));


        $em = $this->getDoctrine()->getManager();
        $em->persist($order);

        for ($i = 0; $i < count($products); $i++) {
            $orderItem = new OrderItem();
            $orderItem->setCount(($products[$i]['count'] == 0) ? 1 : $products[$i]['count']);
            $product = $productsRepository->find($products[$i]['id']);
            if ($product != null) {
                $orderItem->setProduct($product);
                $em->persist($orderItem);
                $orderItem->setOrder($order);
            }
        }

        $em->flush();

        $session = new Session();
        $session->set('cart', []);
        $session->set('sum', 0);

        return new JsonResponse(['ok' => true, 'code' => $order->getId()]);
    }

    /**
     * @param $code
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($code)
    {
        $order = $this->getDoctrine()->getRepository("ShopBundle:Order")->find($code);

        if ($order == null) {
            throw new NotFoundHttpException(sprintf('Product with id = %d not found', $code));
        }

        $products = $order->getProducts();

        $sum = 0;

        for ($i = 0; $i < count($products); $i++) {
            $products[$i]->setOrder(null);
            $product = $products[$i]->getProduct();
            $product->setCategory(null);
            $product->setSubcategory(null);
            $product->setProductSpecifications(null);
            $sum += $product->getPrice() * $products[$i]->getCount();
            $products[$i]->setProduct($product);
        }

        $result = $this->baseLoad();
        $result['products'] = $products;
        $result['status'] = strval($order->getStatus());
        $result['sumS'] = $sum;
        $result['code'] = $code;

        return $this->render('ShopBundle:default:order.html.twig', $result);
    }
}