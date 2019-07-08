<?php

namespace App\Form;

use App\Entity\Target;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TargetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('geography', null, [
                'label' => 'Géographie',
                'required' => false
            ])
            ->add('ve', null, [
                'label' => 'VE',
                'required' => false
            ])
            ->add('investmentTicket', null, [
                'label' => 'Ticket d\'investissement (M€)',
                'required' => false
            ])
            ->add('investmentSector', null, [
                'label' => 'Secteur d\'investissement',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Target::class,
        ]);
    }
}
