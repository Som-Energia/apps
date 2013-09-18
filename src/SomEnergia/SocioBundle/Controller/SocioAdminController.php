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
        $glid = 1;
        $em = $this->getDoctrine()->getManager();
        /** @var GrupoLocal $grupoLocal */
        $grupoLocal = $em->getRepository('GrupoLocalBundle:GrupoLocal')->find($glid);
        /** @var array $socios */
        $sociosDB = $em->getRepository('SocioBundle:Socio')->findAll();
        $row = 1;
        $excelService = $this->get('xls.service_xls2007');
        $excelService->excelObj->getProperties()->setCreator("Som Energia")
            ->setLastModifiedBy("Som Energia")
            ->setTitle("Socios del grupo local de " . $grupoLocal->getNombre())
            ->setSubject("Socios del grupo local de " . $grupoLocal->getNombre())
            ->setDescription("Som Energia socios export document for Office 2007 XLS, generated using PHP classes.")
            ->setKeywords("office 2007 php som energia socio")
            ->setCategory("Result file");
        $excelService->excelObj->setActiveSheetIndex(0)
            ->setCellValue('A' . $row, 'Número')
            ->setCellValue('B' . $row, 'Nombre')
            ->setCellValue('C' . $row, 'Email')
            ->setCellValue('D' . $row, 'Idioma')
        ;
        /** @var Socio $socioDB */
        foreach ($sociosDB as $socioDB) {
            if ($socioDB->containsAZipCodeOf($grupoLocal->getCodigosPostales())) {
                $row++;
                $excelService->excelObj->setActiveSheetIndex(0)
                    ->setCellValue('A' . $row, $socioDB->getRef())
                    ->setCellValue('B' . $row, $socioDB->getName())
                    ->setCellValue('C' . $row, $socioDB->getEmail())
                    ->setCellValue('D' . $row, $socioDB->getLanguage())
                ;
            }
        }
        $excelService->excelObj->getActiveSheet()->setTitle('Socios');
        $excelService->excelObj->setActiveSheetIndex(0);

        //create the response
        $response = $excelService->getResponse();
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=socios-export-' . date('Y-m-d') . '.xls');

        /* If you are using a https connection, you have to set those two headers and use sendHeaders() for compatibility with IE <9
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->sendHeaders();*/
        return $response;
        //return $this->redirect('related-list');
    }
}