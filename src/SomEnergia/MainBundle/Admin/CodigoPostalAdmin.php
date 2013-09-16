<?php
namespace SomEnergia\MainBundle\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Translator;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use SomEnergia\MainBundle\Entity\CodigoPostal;

class CodigoPostalAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('id')
            ->addIdentifier('cp', null, array('label' => 'Código Postal'))
            ->add('poblacion', null, array('label' => 'Población'))
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
        '_sort_by' => 'poblacion' // field name
    );

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('cp', null, array('label' => 'Código Postal'))
            ->add('poblacion', null, array('label' => 'Población'))
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('cp', null, array('label' => 'Código Postal'))
            ->add('poblacion', null, array('label' => 'Población'))
        ;
    }
}