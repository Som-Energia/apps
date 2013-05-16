<?php
namespace SomEnergia\AsambleaBundle\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Translator;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\PageBundle\Model\PageInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;

use SomEnergia\AsambleaBundle\Entity\Sede;

class AsistenciaAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->addIdentifier('id')
        ->add('socio', null, array('label' => 'Socio'))
        ->add('asamblea', null, array('label' => 'Asamblea'))
        ->add('sede', null, array('label' => 'Sede'))
        // add custom action links
            ->add('_action', 'actions', array(
            'actions' => array(
                //'view' => array(),
                //'edit' => array(),
            ),
            'label' => 'Acciones'))
        ;
    }

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'ASC', // sort direction
        '_sort_by' => 'id' // field name
    );

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('asamblea', null, array('label' => 'Asamblea'))
            ->add('sede', null, array('label' => 'Sede'))
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('socio','sonata_type_model', array('label' => 'Socio'), array())
            ->add('asamblea','sonata_type_model', array('label' => 'Asamblea'), array())
            ->add('sede','sonata_type_model', array('label' => 'Sede'), array())
        ;
    }
}