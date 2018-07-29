<?php

namespace ShopBundle\Controller;


use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class StatusController extends BaseController
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function statusAction(Request $request)
    {
        $result = $this->baseLoad();

        $form =
            $this->createFormBuilder()->add('id', NumberType::class, ['label' => 'Введите номер заказа: '])->add('save',
                SubmitType::class, array('label' => 'Найти'))->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            return $this->redirect($this->generateUrl('shop_order', ['code' => $data['id']]));
        }

        $result['form'] = $form->createView();
        return $this->render('ShopBundle:default:status.html.twig', $result);
    }
}