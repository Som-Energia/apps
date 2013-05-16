<?php

namespace SomEnergia\AsambleaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SomEnergia\AsambleaBundle\Form\SelectAsistenciaUsuarioType;
//use SomEnergia\AsambleaBundle\Entity\Asamblea;

class AsistenciaController extends Controller
{

    public function nuevoAction()
    {
        $request = $this->getRequest();
        $form = $this->createForm(new SelectAsistenciaUsuarioType());
        if ($request->isMethod('POST')) {
            // validar datos enviados
            $form->bind($request);
            if ($form->isValid()) {
                // cargar resultados y pasar a la siguiente vista
                $data = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $socios = $em->getRepository('SocioBundle:Socio')->getItemsByNumberOrDniOrName($data['numero'], $data['dni'], $data['nombre']);
                return $this->render('AsambleaBundle:Asistencia:listado.html.twig', array(
                    'form' => $form,
                    'socios' => $socios,
                ));
            }
        }
        return $this->render('AsambleaBundle:Asistencia:nuevo.html.twig', array(
            'form' => $form->createView(),
        ));
        /*


                $results = array();

                $tempRes = $form->getData();
                $asamblea = $em->getRepository('AsambleaBundle:Asamblea')->find($tempRes['asamblea']->getId());

                foreach ($sedes as $sede) {
                    $temp = array();
                    $temp['sede'] = $sede;
                    $asistencias = $em->getRepository('AsambleaBundle:Asistencia')->getItemsByAsambleaIdAndSedeId($asamblea->getId(), $sede->getId());
                    $temp['asistencias'] = count($asistencias);
                    array_push($results, $temp);
                }

            }
        }
        return $this->render('AsambleaBundle:Informe:choose.html.twig', array(
            'form' => $form->createView(),
        ));*/
    }

}
