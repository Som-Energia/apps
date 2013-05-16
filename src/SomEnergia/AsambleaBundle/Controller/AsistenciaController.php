<?php

namespace SomEnergia\AsambleaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SomEnergia\AsambleaBundle\Form\SelectAsistenciaUsuarioType;
use SomEnergia\AsambleaBundle\Entity\Asistencia;

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
                if (strlen($data['numero']) == 0 && strlen($data['dni']) == 0 && strlen($data['nombre']) == 0) {
                    // bloquea el acceso a la consulta vacio (que obtiene todos los resultados)
                    $socios = array();
                } else {
                    $socios = $em->getRepository('SocioBundle:Socio')->getItemsByNumberOrDniOrName($data['numero'], $data['dni'], $data['nombre']);
                }
                $asambleas = $em->getRepository('AsambleaBundle:Asamblea')->getAllItemsSortedByNombre();
                $sedes = $em->getRepository('AsambleaBundle:Sede')->getAllItemsSortedByNombre();
                return $this->render('AsambleaBundle:Asistencia:listado.html.twig', array(
                    'form' => $form,
                    'socios' => $socios,
                    'asambleas' => $asambleas,
                    'sedes' => $sedes,
                ));
            }
        }
        return $this->render('AsambleaBundle:Asistencia:nuevo.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function seleccionadoAction()
    {
        $request = $this->getRequest();
        $form = $this->createForm(new SelectAsistenciaUsuarioType());
        $socioID    = $this->get('request')->request->get('optionSocio');
        $sedeID     = $this->get('request')->request->get('optionSede');
        $asambleaID = $this->get('request')->request->get('optionAsamblea');
        if ($request->isMethod('POST')) {
            if (intval($socioID) > 0 && intval($sedeID) > 0 && intval($asambleaID)) {
                $em = $this->getDoctrine()->getManager();
                $socio    = $em->getRepository('SocioBundle:Socio')->find(intval($socioID));
                $sede     = $em->getRepository('AsambleaBundle:Sede')->find(intval($sedeID));
                $asamblea = $em->getRepository('AsambleaBundle:Asamblea')->find(intval($asambleaID));
                if ($socio && $sede && $asamblea) {
                    $asistencia = new Asistencia();
                    $asistencia->setSocio($socio);
                    $asistencia->setSede($sede);
                    $asistencia->setAsamblea($asamblea);
                    $query = $em->createQuery('SELECT a FROM AsambleaBundle:Asistencia a WHERE a.socio = :socioID AND a.sede = :sedeID AND a.asamblea = :asambleaID');
                    $query->setParameter('socioID', $socio->getId());
                    $query->setParameter('sedeID', $sede->getId());
                    $query->setParameter('asambleaID', $asamblea->getId());
                    $asistenciaBD = $query->getOneOrNullResult();
                    if (is_null($asistenciaBD)) {
                        // no existe, es nuevo y correcto
                        $em->persist($asistencia);
                        $em->flush();
                        $this->get('session')->setFlash('info', 'Has registrado la asistencia del socio "' . $socio. '" en la sede "' . $sede . '" para la asamblea "' . $asamblea->toStringLong() . '" correctamente');
                    } else {
                        $this->get('session')->setFlash('error', 'Ya existe registrada la asistencia del socio "' . $socio. '" en la sede "' . $sede . '" para la asamblea "' . $asamblea->toStringLong() . '". Código error: 504');
                    }
                } else {
                    $this->get('session')->setFlash('error', 'Se ha producido un error inesperado. Código error: 503');
                }
            } else {
                $this->get('session')->setFlash('error', 'Se ha producido un error inesperado. Código error: 502');
            }
        } else {
            $this->get('session')->setFlash('error', 'Se ha producido un error inesperado. Código error: 501');
        }
        return $this->render('AsambleaBundle:Asistencia:nuevo.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
