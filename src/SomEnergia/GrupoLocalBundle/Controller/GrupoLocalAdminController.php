<?php
namespace SomEnergia\GrupoLocalBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use SomEnergia\GrupoLocalBundle\Entity\GrupoLocal;
use SomEnergia\GrupoLocalBundle\Form\SelectPostalCodesType;

class GrupoLocalAdminController extends Controller
{
    public function addPostalCodesAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var GrupoLocal $grupoLocal */
        $grupoLocal = $em->getRepository('GrupoLocalBundle:GrupoLocal')->find($id);

        $request = $this->getRequest();
        $form = $this->createForm(new SelectPostalCodesType());
        if ($request->isMethod('POST')) {
            // validar datos enviados
            $form->handleRequest($request);
            if ($form->isValid()) {
                // cargar resultados y pasar a la siguiente vista
                $data = $form->getData();
                $codigosPostales = $em->getRepository('MainBundle:CodigoPostal')->findItemsThatStartWith($data['cp']);
                return $this->render('GrupoLocalBundle:Admin:add-postalcodes-step2.html.twig', array(
                    'grupolocal' => $grupoLocal,
                    'form' => $form->createView(),
                    'codigosPostales' => $codigosPostales,
                ));
            }
        }

        //return $this->redirect('../list');
        return $this->render('GrupoLocalBundle:Admin:add-postalcodes-step1.html.twig', array(
            'grupolocal' => $grupoLocal,
            'form' => $form->createView(),
        ));
    }

    public function addPostalCodesStep2Action($id)
    {

    }
}