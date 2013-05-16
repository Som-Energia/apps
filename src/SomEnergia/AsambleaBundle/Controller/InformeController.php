<?php

namespace SomEnergia\AsambleaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InformeController extends Controller
{
    // Step 1
    public function chooseAction()
    {
        return $this->render('AsambleaBundle:Informe:choose.html.twig');
    }
}
