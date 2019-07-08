<?php

namespace App\Form;

use App\Entity\Positioning;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PositioningType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('operationType', null, [
                'label' => 'Type d\'opération',
                'required' => false
            ])
            ->add('approach', null, [
                'label' => 'Approche',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Positioning::class,
        ]);
    }
}
