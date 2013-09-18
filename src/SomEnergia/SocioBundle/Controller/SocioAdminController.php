<?php
namespace SomEnergia\SocioBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use SomEnergia\GrupoLocalBundle\Entity\GrupoLocal;

class SocioAdminController extends Controller
{
    public function relatedListAction()
    {
        $glid = 1;
        $em = $this->getDoctrine()->getManager();
        /** @var GrupoLocal $grupoLocal */
        $grupoLocal = $em->getRepository('GrupoLocalBundle:GrupoLocal')->find($glid);

        return $this->render('SocioBundle:Admin:relatedlist.html.twig', array(
            'glid' => $glid,
            'grupoLocal' => $grupoLocal,
        ));
    }
}