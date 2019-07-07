<?php

declare(strict_types=1);

namespace App\Admin;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class TransactionsAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('company')
            ->add('title')
            ->add('content')
            ->add('date')
            ->add('city')
            ->add('createdAt')
            ->add('updatedAt')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('id')
            ->add('company')
            ->add('title')
            ->add('content')
            ->add('date')
            ->add('city')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
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
            ->end()
            ->with('Général', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-success'
            ])
            ->add('title', CKEditorType::class, [
                'label' => 'Titre'
            ])
            ->add('content', CKEditorType::class, [
                'label' => 'Contenu'
            ])
            ->add('company', TextType::class, [
                'label' => 'Société'
            ])
            ->add('date', DatePickerType::class, [
                'label' => 'Date de la transaction'
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville'
            ])
            ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('company')
            ->add('title')
            ->add('content')
            ->add('date')
            ->add('city')
            ->add('createdAt')
            ->add('updatedAt')
            ;
    }
}
