<?php
namespace SomEnergia\AsambleaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SelectAsambleaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builderInterface, array $options)
    {
        $builderInterface->add('asamblea', 'entity', array(
            'class' => 'AsambleaBundle:Asamblea',
            'property' => 'nombre'
        ));
    }

    public function getName()
    {
        return 'somenergia_asambleabundle_selectasambleatype';
    }
}