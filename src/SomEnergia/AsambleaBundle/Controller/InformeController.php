<?php

namespace SomEnergia\AsambleaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SomEnergia\AsambleaBundle\Form\SelectAsambleaType;
use SomEnergia\AsambleaBundle\Entity\Asamblea;

class InformeController extends Controller
{

    public function chooseAction()
    {
        $request = $this->getRequest();
        $form = $this->createForm(new SelectAsambleaType());
        if ($request->isMethod('POST')) {
            // validar datos enviados
            $form->bind($request);
            if ($form->isValid()) {
                // cargar resultados y pasar a la siguiente vista
                $results = array();
                $em = $this->getDoctrine()->getManager();
                $tempRes = $form->getData();
                $asamblea = $em->getRepository('AsambleaBundle:Asamblea')->find($tempRes['asamblea']->getId());
                $sedes = $em->getRepository('AsambleaBundle:Sede')->getAllItemsSortedByNombre();
                foreach ($sedes as $sede) {
                    $temp = array();
                    $temp['sede'] = $sede;
                    $asistencias = $em->getRepository('AsambleaBundle:Asistencia')->getItemsByAsambleaIdAndSedeId($asamblea->getId(), $sede->getId());
                    $temp['asistencias'] = count($asistencias);
                    array_push($results, $temp);
                }
                return $this->render('AsambleaBundle:Informe:selected.html.twig', array(
                    'asamblea' => $asamblea,
                    'results' => $results,
                ));
            }
        }
        return $this->render('AsambleaBundle:Informe:choose.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
