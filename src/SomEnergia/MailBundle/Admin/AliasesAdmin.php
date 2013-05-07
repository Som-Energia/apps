<?php
namespace SomEnergia\MailBundle\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Translator;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
//use Sonata\PageBundle\Model\PageInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;

use SomeEnergia\MailBundle\Entity\Aliases;

class AliasesAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('pkid', null, array('label' => 'ID'))
            ->addIdentifier('mail', null, array('label' => 'Email'))
            ->add('destination', null, array('label' => 'Desvíos'))
            ->add('enabled', 'boolean', array('label' => 'Activo'))
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
}