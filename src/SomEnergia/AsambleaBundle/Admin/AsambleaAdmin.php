<?php
namespace SomEnergia\AsambleaBundle\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Translator;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

use SomEnergia\AsambleaBundle\Entity\Asamblea;

class AsambleaAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        //->add('id')
        ->addIdentifier('nombre', null, array('label' => 'Nombre'))
        ->add('fecha', null, array('label' => 'Fecha', 'template' => 'AsambleaBundle:Asamblea:custom.asamblea.fecha.admin.html.twig'))
        // add custom action links
            ->add('_action', 'actions', array(
            'actions' => array(
                //'view' => array(),
                'edit' => array(),
            ),
            'label' => 'Acciones'))
        ;
    }

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'ASC', // sort direction
        '_sort_by' => 'fecha' // field name
    );

    /*protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title', null, array('label' => $translator->trans('page.title')))
            ->add('isActive', null, array('label' => $translator->trans('page.active')))
        ;
    }*/

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nombre', 'text', array('label' => 'Nombre'))
            ->add('fecha', 'date', array('label' => 'Fecha'))
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        //$collection->remove('create');
        $collection->remove('delete');
    }
}