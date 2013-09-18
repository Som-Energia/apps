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
                    'searchedPostalCodes' => $data['cp'],
                ));
            }
        }

        return $this->render('GrupoLocalBundle:Admin:add-postalcodes-step1.html.twig', array(
            'grupolocal' => $grupoLocal,
            'form' => $form->createView(),
        ));
    }

    public function addPostalCodesStep2Action($id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        /** @var GrupoLocal $grupoLocal */
        $grupoLocal = $em->getRepository('GrupoLocalBundle:GrupoLocal')->find($id);
        $codigosPostales = $request->request->get('optionCP');
        if (count($codigosPostales) > 0) {
            foreach ($codigosPostales as $codigoPostal) {
                $codigoPostalDB = $em->getRepository('MainBundle:CodigoPostal')->find($codigoPostal);
                if ($codigoPostalDB) {
                    $grupoLocal->addCodigosPostale($codigoPostalDB);
                }
            }
            /*if (count($codigosPostales) > 0) {
                $this->container->get('session')->getFlashBag()->add('info', 'Se han añadido ' . count($codigosPostales) . ' códigos postales al grupo local correctamente');
            } else {
                $this->container->get('session')->getFlashBag()->add('error', 'No has añadido ningún código postal al grupo local');
            }*/
            $em->persist($grupoLocal);
            $em->flush();
        }

        return $this->redirect('../list');
    }

    public function removePostalCodesAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var GrupoLocal $grupoLocal */
        $grupoLocal = $em->getRepository('GrupoLocalBundle:GrupoLocal')->find($id);
        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $codigosPostales = $request->request->get('optionCP');
            if (count($codigosPostales) > 0) {
                foreach ($codigosPostales as $codigoPostal) {
                    $codigoPostalDB = $em->getRepository('MainBundle:CodigoPostal')->find($codigoPostal);
                    if ($codigoPostalDB) {
                        $grupoLocal->removeCodigosPostale($codigoPostalDB);
                    }
                }
                $em->persist($grupoLocal);
                $em->flush();
            }

            return $this->redirect('../list');
        }

        return $this->render('GrupoLocalBundle:Admin:remove-postalcodes-step1.html.twig', array(
            'grupolocal' => $grupoLocal,
            //'form' => $form->createView(),
        ));
    }
}