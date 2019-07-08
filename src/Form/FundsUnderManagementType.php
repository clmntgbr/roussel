<?php

namespace App\Form;

use App\Entity\FundsUnderManagement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FundsUnderManagementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('capitalStructure', null, [
                'label' => 'Structure du capital',
                'required' => false
            ])
            ->add('managedCapital', null, [
                'label' => 'Capitaux gérés',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FundsUnderManagement::class,
        ]);
    }
}
