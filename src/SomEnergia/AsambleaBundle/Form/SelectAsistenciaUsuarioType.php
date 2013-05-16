<?php
namespace SomEnergia\AsambleaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SelectAsistenciaUsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builderInterface, array $options)
    {
        $builderInterface
            ->add('numero', 'text', array('label' => 'Número de socio', 'required' => false))
            ->add('dni', 'text', array('label' => 'DNI', 'required' => false))
            ->add('nombre', 'text', array('required' => false));
    }

    public function getName()
    {
        return 'somenergia_asambleabundle_selectasistenciausuariotype';
    }
}