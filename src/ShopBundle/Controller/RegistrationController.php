<?php

namespace ShopBundle\Controller;


use ShopBundle\Entity\City;
use ShopBundle\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends BaseController
{
    /**
     * @param Request $request
     * @param $orderId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function registrationAction(Request $request, $orderId)
    {
        $result = $this->baseLoad();

        $years = $this->getYearsList();
        $client = new Client();

        $form = $this->createFormBuilder($client)->add('secondName', TextType::class,
            ['label' => 'Фамилия: '])->add('firstName', TextType::class, ['label' => 'Имя: '])->add('fatherName',
            TextType::class, ['label' => 'Отчество: '])->add('birthday', DateType::class,
            ['label' => 'Дата рождения: ', 'years' => $years])->add('city', EntityType::class,
            ['class' => City::class, 'property' => 'name', 'label' => 'Город: '])->add('save', SubmitType::class,
            array('label' => 'Сохранить'))->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $client = $form->getData();
            $clients = $this->getDoctrine()->getRepository("ShopBundle:Client")->findCopy($client);

            if (count($clients) > 0) {
                $client = $clients[0];
            } else {
                $em->persist($client);
            }

            $order = $this->getDoctrine()->getRepository("ShopBundle:Order")->find($orderId);
            $order->setClient($client);

            $em->persist($order);
            $em->flush();
            return $this->redirect($this->generateUrl('shop_order', ['code' => $order->getId()]));
        }

        $result['form'] = $form->createView();
        return $this->render('ShopBundle:default:registration.html.twig', $result);
    }
}