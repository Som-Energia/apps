<?php
namespace SomEnergia\SocioBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use SomEnergia\GrupoLocalBundle\Entity\GrupoLocal;
use SomEnergia\SocioBundle\Entity\Socio;

class SocioAdminController extends Controller
{
    public function relatedListAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        /** @var GrupoLocal $grupoLocal */
        $grupoLocal = $user->getGrupoLocal();
        /** @var array $socios */
        $sociosDB = $em->getRepository('SocioBundle:Socio')->findAll();
        $socios = array();
        if ($grupoLocal && $grupoLocal->getCodigosPostales()) {
            /** @var Socio $socioDB */
            foreach ($sociosDB as $socioDB) {
                if ($socioDB->containsAZipCodeOf($grupoLocal->getCodigosPostales())) {
                    array_push($socios, $socioDB);
                }
            }
        }

        return $this->render('SocioBundle:Admin:relatedlist.html.twig', array(
            'grupoLocal' => $grupoLocal,
            'socios' => $socios,
        ));
    }

    public function exportRelatedListAction()
    {
//        $logger = $this->get('logger');
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        /** @var GrupoLocal $grupoLocal */
        $grupoLocal = $user->getGrupoLocal();
        /** @var array $socios */
        $sociosDB = $em->getRepository('SocioBundle:Socio')->findAll();
        $row = 1;
        //$logger->debug(__METHOD__ . ' :: line 42');

        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();
        $phpExcelObject->getProperties()->setCreator("Som Energia")
            ->setLastModifiedBy("Som Energia")
            ->setTitle("Socios del grupo local de " . $grupoLocal->getNombre())
            ->setSubject("Socios del grupo local de " . $grupoLocal->getNombre())
            ->setDescription("Som Energia socios export document for Office 2007 XLS, generated using PHP classes.")
            ->setKeywords("office 2007 php som energia socio")
            ->setCategory("Result file");
        //$logger->debug(__METHOD__ . ' :: line 51');
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A' . $row, 'Número')
            ->setCellValue('B' . $row, 'Nombre')
            ->setCellValue('C' . $row, 'Email')
            ->setCellValue('D' . $row, 'CP')
            ->setCellValue('E' . $row, 'Población')
            ->setCellValue('F' . $row, 'Idioma')
        ;
        //$logger->debug(__METHOD__ . ' :: line 58');
        /** @var Socio $socioDB */
        foreach ($sociosDB as $socioDB) {
            if ($socioDB->containsAZipCodeOf($grupoLocal->getCodigosPostales())) {
                $row++;
                $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('A' . $row, $socioDB->getRef())
                    ->setCellValue('B' . $row, $socioDB->getName())
                    ->setCellValue('C' . $row, $socioDB->getEmail())
                    ->setCellValue('D' . $row, $socioDB->getZip())
                    ->setCellValue('E' . $row, $socioDB->getCity())
                    ->setCellValue('F' . $row, $socioDB->getLanguage())
                ;
                //$logger->debug(__METHOD__ . ' :: line 69 :: row ' . $row . ' :: soci ' . $socioDB);
            }
        }
        $phpExcelObject->getActiveSheet()->setTitle('Socios');
        $phpExcelObject->setActiveSheetIndex(0);
        //$logger->debug(__METHOD__ . ' :: line 74');
        //create the response
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        $response->headers->set('Content-Type', 'application/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'inline;filename=socios-export-' . date('Y-m-d') . '.xls');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response;
    }
}