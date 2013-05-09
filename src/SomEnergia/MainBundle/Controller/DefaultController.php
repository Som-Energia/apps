<?php

namespace SomEnergia\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('sonata_admin_dashboard'));
        //return $this->render('MainBundle:Default:index.html.twig', array('name' => ''));
    }
}
