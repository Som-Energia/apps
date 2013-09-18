<?php
namespace SomEnergia\SocioBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;

class SocioAdminController extends Controller
{
    public function relatedListAction()
    {
        return $this->render('SocioBundle:Admin:relatedlist.html.twig', array(
        ));
    }
}