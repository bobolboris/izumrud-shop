<?php

namespace ShopBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ComparatorController extends BaseController
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addProductToCompareListAction(Request $request)
    {
        $id = $request->get('id');
        if (!isset($id)) {
            return new JsonResponse(['ok' => false]);
        }

        $productRepository = $this->getDoctrine()->getRepository("ShopBundle:Product");

        if ($productRepository->find($id) == null) {
            return new JsonResponse(['ok' => false]);
        }

        $session = new Session();
        $cmpList = ($session->has('cmp')) ? $session->get('cmp') : [];
        if (in_array($id, $cmpList)) {
            return new JsonResponse(['ok' => false]);
        }

        $cmpList[] = $id;
        $session->set('cmp', $cmpList);
        return new JsonResponse(['ok' => true]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function removeFromCompareListAction(Request $request)
    {
        $id = $request->get('id');
        if (!isset($id)) {
            return new JsonResponse(['ok' => false]);
        }

        $session = new Session();
        $cmpList = ($session->has('cmp')) ? $session->get('cmp') : [];


        for ($i = 0; $i < count($cmpList); $i++) {
            if ($cmpList[$i] == $id) {
                break;
            }
        }

        if ($i == count($cmpList)) {
            return new JsonResponse(['ok' => false]);
        }

        unset($cmpList[$i]);
        sort($cmpList);

        $session->set('cmp', $cmpList);

        return new JsonResponse(['ok' => true]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function comparatorViewAction()
    {
        $result = $this->baseLoad();
        $productRepository = $this->getDoctrine()->getRepository("ShopBundle:Product");
        $products = [];

        $session = new Session();

        $cmpList = ($session->has('cmp')) ? $session->get('cmp') : [];

        for ($i = 0; $i < count($cmpList); $i++) {
            $tmp = $productRepository->find($cmpList[$i]);
            if ($tmp != null) {
                $products[] = $tmp;
            }
        }

        $result['values'] = CompareListController::generateCompareItemArray($products);
        $result['products'] = $products;
        return $this->render('ShopBundle:default:comparator.html.twig', $result);
    }


}