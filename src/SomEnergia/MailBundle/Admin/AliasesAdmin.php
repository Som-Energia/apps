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
        $listMapper->addIdentifier('pkid', null, array('label' => 'ID'))
            ->addIdentifier('mail', null, array('label' => 'Email'))
            ->add('destination', null, array('label' => 'Desvios'))
            ->add('enabled', 'boolean', array('label' => 'Activo'));
    }
}