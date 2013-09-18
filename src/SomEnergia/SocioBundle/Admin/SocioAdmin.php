<?php
namespace SomEnergia\SocioBundle\Admin;

use Symfony\Component\HttpFoundation\Request;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\PageBundle\Model\PageInterface;
use Sonata\AdminBundle\Route\RouteCollection;

class SocioAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        //->add('id', null, array('label' => 'ID'))
        //->add('erpid', null, array('label' => 'ERPID'))
        ->add('ref', null, array('label' => 'Número'))
        ->add('vat', null, array('label' => 'DNI'))
        ->addIdentifier('name', null, array('label' => 'Nombre'))
        ->add('zip', null, array('label' => 'CP'))
        ->add('city', null, array('label' => 'Población'))
        ->add('email', null, array('label' => 'Email'))
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
        '_sort_by' => 'name' // field name
    );

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('ref', null, array('label' => 'Número'))
            ->add('vat', null, array('label' => 'DNI'))
            ->add('name', null, array('label' => 'Nombre'))
            ->add('zip', null, array('label' => 'CP'))
            ->add('city', null, array('label' => 'Población'))
            ->add('email', null, array('label' => 'Email'))
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id', null, array('label' => 'ID', 'read_only' => true))
            ->add('erpid', null, array('label' => 'ERPID', 'read_only' => true))
            ->add('ref', null, array('label' => 'Número'))
            ->add('vat', null, array('label' => 'DNI'))
            ->add('name', null, array('label' => 'Nombre'))
            ->add('street', null, array('label' => 'Calle'))
            ->add('zip', null, array('label' => 'CP'))
            ->add('city', null, array('label' => 'Población'))
            ->add('email', null, array('label' => 'Email'))
            ->add('phone', null, array('label' => 'Teléfono'))
            ->add('mobile', null, array('label' => 'Móvil'))
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('relatedlist', 'related-list');
        $collection->add('exportrelatedlist', 'export-related-list');
        $collection->remove('create');
        $collection->remove('delete');
    }
}