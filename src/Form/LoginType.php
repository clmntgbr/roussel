<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', null, [
                'label' => 'Email'
            ])
            ->add('password', null, [
                'label' => 'Password'
            ]);
    }
}
