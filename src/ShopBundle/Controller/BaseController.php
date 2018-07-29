<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class BaseController extends Controller
{
    /**
     * @return array
     */
    protected function baseLoad()
    {
        $session = new Session();
        $currencyId = 1;
        if (!$session->has('currencyId')) {
            $session->set('currencyId', $currencyId);
        } else {
            $currencyId = $session->get('currencyId');
        }

        $cart = ($session->has('cart')) ? $session->get('cart') : [];
        $sum = ($session->has('sum')) ? $session->get('sum') : 0;
        $cmpList = ($session->has('cmp')) ? $session->get('cmp') : [];

        $em = $this->getDoctrine();
        $currencies = $em->getRepository("ShopBundle:Currency")->findAll();
        $menuTitles = $em->getRepository("ShopBundle:Category")->findAll();
        $currency = $em->getRepository("ShopBundle:Currency")->find($currencyId);
        return [
            'currencies' => $currencies,
            'menutitles' => $menuTitles,
            'currency' => $currency,
            'cart' => $cart,
            'sum' => $sum,
            'cmp' => $cmpList
        ];
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeCurrentCurrencyAction(Request $request)
    {
        $id = $request->get('id');
        if (!isset($id)) {
            return new JsonResponse(['ok' => false]);
        }
        $count = count($this->getDoctrine()->getRepository("ShopBundle:Currency")->findBy(['id' => $id]));
        if ($count == 0) {
            return new JsonResponse(['ok' => false]);
        }
        $session = new Session();
        $session->set('currencyId', $id);
        return new JsonResponse(['ok' => true]);
    }

    /**
     * @return Response
     */
    public function testAction()
    {
        $session = new Session();
        $session->clear();
        return new Response('Test');
    }

    /**
     * @return array
     */
    public function getYearsList()
    {
        $years = [];
        for ($i = date("Y") - 16; $i >= 1920; $i--) {
            $years[] = $i;
        }
        return $years;
    }

}
