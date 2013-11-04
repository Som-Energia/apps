<?php
namespace SomEnergia\GrupoLocalBundle\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Translator;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

use SomEnergia\GrupoLocalBundle\Entity\GrupoLocal;

class GrupoLocalAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('id')
            ->addIdentifier('nombre', null, array('label' => 'Nombre'))
            ->add('codigosPostales', null, array('label' => 'Códigos postales', 'template' => 'GrupoLocalBundle:Admin:postal-codes-bunch.html.twig'))
            ->add('users', null, array('label' => 'Usuarios'))
            // add custom action links
            ->add('_action', 'actions', array(
                'actions' => array(
                    //'view' => array(),
                    'edit' => array(),
                    'addPostalCodes' => array('template' => 'GrupoLocalBundle:Admin:add-postal-codes-icon.html.twig'),
                    'removePostalCodes' => array('template' => 'GrupoLocalBundle:Admin:remove-postal-codes-icon.html.twig'),
                ),
                'label' => 'Acciones'))
        ;
    }

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'ASC', // sort direction
        '_sort_by' => 'nombre' // field name
    );

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nombre', null, array('label' => 'Nombre'))
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nombre', null, array('label' => 'Nombre'))
            /*->add('users', 'genemu_jqueryselect2_entity', array(
                'label' => 'Usuarios',
                'class' => 'Application\Sonata\UserBundle\Entity\User',
                'property' => 'username',
                'multiple' => true,
            ))*/
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('addPostalCodes', $this->getRouterIdParameter().'/add-postal-codes');
        $collection->add('addPostalCodesStep2', $this->getRouterIdParameter().'/add-postal-codes-step-2');
        $collection->add('removePostalCodes', $this->getRouterIdParameter().'/remove-postal-codes');
        //$collection->remove('create');
        $collection->remove('delete');
    }
}