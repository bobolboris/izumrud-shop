<?php

namespace ShopBundle\Controller;


class ContactController extends BaseController
{
    public function contactAction()
    {
        return $this->render('ShopBundle:default:contact.html.twig', $this->baseLoad());
    }
}