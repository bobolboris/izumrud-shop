<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.04.18
 * Time: 14:17
 */

namespace ShopBundle\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class CartController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cartAction()
    {
        $result = $this->baseLoad();
        $session = new Session();
        $cart = ($session->has('cart')) ? $session->get('cart') : [];
        $products = [];
        if (count($cart) > 0) {
            $productRepo = $this->getDoctrine()->getRepository("ShopBundle:Product");
            foreach ($cart as $id) {
                $tmp = $productRepo->find($id);
                if (isset($tmp)) {
                    $products[] = $tmp;
                }
            }
        }
        $result['products'] = $products;
        return $this->render('ShopBundle:default:cart.html.twig', $result);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function buyAction(Request $request)
    {
        $id = $request->get('id');

        if (!isset($id)) {
            return new JsonResponse(['ok' => false]);
        }

        $session = new Session();
        $cart = ($session->has('cart')) ? $session->get('cart') : [];

        if (in_array($id, $cart)) {
            return new JsonResponse(['ok' => false]);
        }

        $tmp = $this->getDoctrine()->getRepository("ShopBundle:Product")->find($id);
        $price = (isset($tmp)) ? $tmp->getPrice() : 0;
        $sum = ($session->has('sum')) ? $session->get('sum') : 0;
        $sum += $price;
        $cart[] = $id;
        $session->set('cart', $cart);
        $session->set('sum', $sum);
        return new JsonResponse(['ok' => true, 'sum' => $sum]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function removeAction(Request $request)
    {
        $id = $request->get('id');

        if (!isset($id)) {
            return new JsonResponse(['ok' => false]);
        }

        $session = new Session();
        $cart = ($session->has('cart')) ? $session->get('cart') : [];
        $sum = ($session->has('sum')) ? $session->get('sum') : 0;

        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i] == $id) {
                break;
            }
        }

        if ($i == count($cart)) {
            return new JsonResponse(['ok' => false]);
        }

        $productRepository = $this->getDoctrine()->getRepository("ShopBundle:Product");
        $product = $productRepository->find($id);

        if ($product == null) {
            return new JsonResponse(['ok' => false]);
        }

        if ($sum >= $product->getPrice()) {
            $sum -= $product->getPrice();
        }

        unset($cart[$i]);
        sort($cart);
        $session->set('cart', $cart);
        $session->set('sum', $sum);
        return new JsonResponse(['ok' => true]);
    }
}