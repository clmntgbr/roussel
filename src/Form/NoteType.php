<?php

namespace App\Form;

use App\Entity\Note;
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Sujet',
                'required' => false
            ])
            ->add('createdAt', DatePickerType::class, [
                'format' => 'dd/MM/yyyy, H:mm:ss',
                'label' => 'Date de création de la note',
                'required' => false,
                'disabled' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
