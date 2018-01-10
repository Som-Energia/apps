<?php

namespace SomEnergia\SocioBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class SocioAdmin
 */
class SocioAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'ASC', // sort direction
        '_sort_by' => 'name' // field name
    );

    /**
     * @param ListMapper $listMapper
     */
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

    /**
     * @param DatagridMapper $datagridMapper
     */
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

    /**
     * @param FormMapper $formMapper
     */
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

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('relatedlist', 'related-list');
        $collection->add('exportrelatedlist', 'export-related-list');
        $collection->remove('create');
        $collection->remove('delete');
    }
}
