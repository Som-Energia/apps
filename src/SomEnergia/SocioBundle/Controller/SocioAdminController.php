<?php
namespace SomEnergia\SocioBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use SomEnergia\GrupoLocalBundle\Entity\GrupoLocal;
use SomEnergia\SocioBundle\Entity\Socio;

class SocioAdminController extends Controller
{
    public function relatedListAction()
    {
        $glid = 1;
        $em = $this->getDoctrine()->getManager();
        /** @var GrupoLocal $grupoLocal */
        $grupoLocal = $em->getRepository('GrupoLocalBundle:GrupoLocal')->find($glid);
        /** @var array $socios */
        $sociosDB = $em->getRepository('SocioBundle:Socio')->findAll();
        $socios = array();
        /** @var Socio $socioDB */
        foreach ($sociosDB as $socioDB) {
            if ($socioDB->containsAZipCodeOf($grupoLocal->getCodigosPostales())) {
                array_push($socios, $socioDB);
            }
        }

        return $this->render('SocioBundle:Admin:relatedlist.html.twig', array(
            'glid' => $glid,
            'grupoLocal' => $grupoLocal,
            'socios' => $socios,
        ));
    }

    public function exportRelatedListAction()
    {
        return $this->redirect('related-list');
    }
}