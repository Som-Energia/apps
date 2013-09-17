<?php
namespace SomEnergia\MailBundle\Admin;

use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\Translation\Translator;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

use SomeEnergia\MailBundle\Entity\Aliases;

class AliasesAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('pkid', null, array('label' => 'ID'))
            ->addIdentifier('mail', null, array('label' => 'Email'))
            ->add('destination', null, array('label' => 'Desvíos'))
            ->add('enabled', 'boolean', array('label' => 'Activo', 'editable' => true))
            ->add('_action', 'actions', array(
                'actions' => array(
                //'view' => array(),
                'edit' => array(),
            ), 'label' => 'Acciones'))
        ;
    }

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'ASC', // sort direction
        '_sort_by' => 'mail' // field name
    );

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('mail', null, array('label' => 'Email'))
            ->add('destination', null, array('label' => 'Desvíos'))
            ->add('enabled', null, array('label' => 'Activo'))
        ;
    }

    /*protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('pkid')
            ->add('mail')
            ->add('destination')
            ->add('enabled')
        ;
    }*/

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('mail', 'text', array('label' => 'Email'))
            ->add('destination', 'text', array('label' => 'Desvíos'))
            ->add('enabled', 'checkbox', array('label' => 'Activo', 'required' => false))
            ->setHelps(array(
                'destination' => 'Introduce múltiples direcciones separadas por comas'))
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        //$collection->remove('create');
        $collection->remove('delete');
    }
}