<?php
namespace SomEnergia\GrupoLocalBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use SomEnergia\GrupoLocalBundle\Entity\GrupoLocal;

class GrupoLocalAdminController extends Controller
{
    public function addPostalCodesAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var GrupoLocal $grupoLocal */
        $grupoLocal = $em->getRepository('GrupoLocalBundle:GrupoLocal')->find($id);

        //return $this->redirect('../list');
        return $this->render('GrupoLocalBundle:Admin:add-postalcodes-step1.html.twig', array('grupolocal' => $grupoLocal));
    }
}