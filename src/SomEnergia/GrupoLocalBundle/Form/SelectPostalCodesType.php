<?php
namespace SomEnergia\GrupoLocalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SelectPostalCodesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builderInterface, array $options)
    {
        $builderInterface
            ->add('cp', 'text', array('label' => 'Buscar códigos postales que empiezan por', 'required' => true))
            ;
    }

    public function getName()
    {
        return 'somenergia_grupolocalbundle_selectpostalcodestype';
    }
}