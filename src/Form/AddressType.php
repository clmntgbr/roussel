<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('street', null, [
                'label' => 'Rue',
                'required' => false
            ])
            ->add('city', null, [
                'label' => 'Ville',
                'required' => false
            ])
            ->add('postalCode', null, [
                'label' => 'Code Postal',
                'required' => false
            ])
            ->add('country', null, [
                'label' => 'Pays',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
