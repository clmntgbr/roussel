<?php

namespace App\Admin;

use App\Form\AddressType;
use App\Form\FundsUnderManagementType;
use App\Form\NoteType;
use App\Form\PersonType;
use App\Form\PositioningType;
use App\Form\TargetType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class InvestmentFundsAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('phoneNumber')
            ->add('contactEmail')
            ->add('website')
            ->add('dateCreation')
            ->add('createdAt')
            ->add('updatedAt')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('phoneNumber')
            ->add('contactEmail')
            ->add('website')
            ->add('dateCreation')
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
            ->add('name', null, [
                'required' => false,
                'label' => 'Nom'
            ])
            ->add('phoneNumber', null, [
                'required' => false,
                'label' => 'Numéro de téléphone'
            ])
            ->add('contactEmail', null, [
                'required' => false,
                'label' => 'Email de contact'
            ])
            ->add('website', null, [
                'required' => false,
                'label' => 'Site Web'
            ])
            ->add('dateCreation', DatePickerType::class, [
                'required' => false,
                'label' => 'Date de création du fond d\'investissement'
            ])
            ->end()
            ->with('Adresse', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-success'
            ])
            ->add('address', AddressType::class, [
                'label' => false
            ])
            ->end()
            ->with('Cible', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-success'
            ])
            ->add('target', TargetType::class, [
                'label' => false
            ])
            ->end()
            ->with('Fonds sous gestion', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-success'
            ])
            ->add('fundsUnderManagement', FundsUnderManagementType::class, [
                'label' => false
            ])
            ->end()
            ->with('Positionnement', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-success'
            ])
            ->add('positioning', PositioningType::class, [
                'label' => false
            ])
            ->end()
            ->with('Notes', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-success'
            ])
            ->add('notes', CollectionType::class, [
                'label' => false,
                'entry_type' => NoteType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false
            ])
            ->end()
            ->with('Contacts', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-success'
            ])
            ->add('contacts', CollectionType::class, [
                'label' => false,
                'entry_type' => PersonType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false
            ])
            ->end();
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('phoneNumber')
            ->add('contactEmail')
            ->add('website')
            ->add('dateCreation')
            ->add('createdAt')
            ->add('updatedAt')
            ;
    }
}
