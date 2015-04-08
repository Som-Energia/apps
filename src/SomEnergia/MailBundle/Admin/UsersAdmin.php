<?php

namespace SomEnergia\MailBundle\Admin;

use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\Translation\Translator;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class UsersAdmin extends Admin {
    
    protected $classnameLabel = 'Buzones';

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('id', null, array('label' => 'Email'))
                //->add('name', null, array('label' => 'Nombre'))
                //->add('uid')
                //->add('gid')
                //->add('home')
                //->add('maildir')
                ->add('enabled', 'boolean', array('label' => 'Activo', 'editable' => true))
                //->add('changePassword')
                //->add('clear')
                //->add('crypt')
                //->add('quota')
                //->add('procmailrc')
                //->add('spamassassinrc')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'view' => array(),
                        'edit' => array(),
                    ), 'label' => 'Acciones'))
        ;
    }

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'ASC', // sort direction
        '_sort_by' => 'id' // field name
    );

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('id', null, array('label' => 'Email'))
                ->add('enabled', null, array('label' => 'Activo'))
        ;
    }

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
                ->add('id', null, array('label' => 'Email'))
                ->add('clear', null, array('label' => 'Password'))
        ;
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('id', 'text', array('label' => 'Email'))
                ->add('clear', 'text', array('label' => 'Password'))
        ;
    }

    protected function configureRoutes(RouteCollection $collection) {
        //$collection->remove('create');
        $collection->remove('delete');
    }

}
