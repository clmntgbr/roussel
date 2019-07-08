<?php

declare(strict_types=1);

namespace App\Admin;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class TransactionAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('title', null, [
                'label' => 'Titre'
            ])
            ->add('company', null, [
                'label' => 'Nom de la société'
            ])
            ->add('date', null, [
                'label' => 'Date'
            ])
            ->add('city', null, [
                'label' => 'Ville'
            ])
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('id')
            ->add('title', 'html', [
                'label' => 'Titre'
            ])
            ->add('company', TextType::class, [
                'label' => 'Nom de la société'
            ])
            ->add('date', 'date', [
                'label' => 'Date de la transaction',
                'format' => 'd/m/Y',
                'locale' => 'fr',
                'timezone' => 'Europe/Paris'
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('createdAt', null, [
                'label' => 'Date de création',
                'format' => 'd/m/Y H:i:s'
            ])
            ->add('createdBy', TextType::class, [
                'disabled' => true,
                'required' => false
            ])
            ->add('_action', null, [
                'actions' => [
                    'edit' => [
                        'template' => 'edit_button.html.twig'
                    ],
                    'delete' => [
                        'template' => 'delete_button.html.twig'
                    ],
                ]
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->with('Meta Informations', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-warning'
            ])
            ->add('createdAt', DatePickerType::class, [
                'disabled' => true,
                'required' => false,
                'label' => 'Date de Création',
                'format' => 'dd/MM/yyyy, H:mm:ss',
                'view_timezone' => 'Europe/Paris'
            ])
            ->add('updatedAt', DatePickerType::class, [
                'disabled' => true,
                'required' => false,
                'label' => 'Dernière Modification',
                'format' => 'dd/MM/yyyy, H:mm:ss',
                'view_timezone' => 'Europe/Paris'
            ])
            ->add('id', TextType::class, [
                'disabled' => true,
                'required' => false
            ])
            ->add('createdBy', TextType::class, [
                'disabled' => true,
                'required' => false
            ])
            ->end()
            ->with('Général', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-success'
            ])
            ->add('title', CKEditorType::class, [
                'label' => 'Titre',
                'required' => false
            ])
            ->add('content', CKEditorType::class, [
                'label' => 'Contenu',
                'required' => false
            ])
            ->add('company', TextType::class, [
                'label' => 'Société',
                'required' => false
            ])
            ->add('date', DatePickerType::class, [
                'label' => 'Date de la transaction',
                'format' => 'dd/MM/yyyy',
                'required' => false
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'required' => false
            ])
            ->end()
            ;
    }
}
