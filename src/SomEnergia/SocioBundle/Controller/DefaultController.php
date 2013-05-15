<?php

namespace SomEnergia\SocioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SocioBundle:Default:index.html.twig', array('name' => $name));
    }
}
