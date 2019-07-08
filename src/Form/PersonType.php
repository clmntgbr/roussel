<?php

namespace App\Form;

use App\Entity\Person;
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom/Prénom',
                'required' => false
            ])
            ->add('position', null, [
                'label' => 'Fonction',
                'required' => false
            ])
            ->add('phoneNumber', null, [
                'label' => 'Numéro de téléphone',
                'required' => false
            ])
            ->add('contactEmail', null, [
                'label' => 'Email',
                'required' => false
            ])
            ->add('birthday', DatePickerType::class, [
                'label' => 'Anniversaire',
                'format' => 'dd/MM/yyyy',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
