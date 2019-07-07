<?php

namespace App\Admin;

use App\Form\AddressType;
use App\Form\ImplantationType;
use App\Form\NoteType;
use App\Form\OperationType;
use App\Form\PersonType;
use App\Form\SpecialtyType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class SocietiesAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('investmentFund')
            ->add('parentCompany')
            ->add('holding')
            ->add('sector')
            ->add('age')
            ->add('activity')
            ->add('turnover')
            ->add('grossOperatingSurplus')
            ->add('profitBeforeInterestAndTaxes')
            ->add('treasury')
            ->add('financialDebt')
            ->add('siren')
            ->add('phoneNumber')
            ->add('contactEmail')
            ->add('website')
            ->add('dateCreation')
            ->add('dateTurnover')
            ->add('createdAt')
            ->add('updatedAt')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name', null, [
                'label' => 'Nom'
            ])
            ->add('parentCompany', null, [
                'label' => 'Société mère'
            ])
            ->add('activity', null, [
                'label' => 'Activités'
            ])
            ->add('turnover', null, [
                'label' => 'Chiffre d\'affaire'
            ])
            ->add('contactEmail', null, [
                'label' => 'Email'
            ])
            ->add('updatedAt', null, [
                'label' => 'Date modification'
            ])
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
            ->add('investmentFund', null, [
                'required' => false,
                'label' => 'Fond d\'investissement'
            ])
            ->add('parentCompany', null, [
                'required' => false,
                'label' => 'Société mère'
            ])
            ->add('holding', null, [
                'required' => false,
                'label' => 'Holding'
            ])
            ->add('sector', null, [
                'required' => false,
                'label' => 'Secteur d\'activité'
            ])
            ->add('age', null, [
                'required' => false,
                'label' => 'Age'
            ])
            ->add('activity', null, [
                'required' => false,
                'label' => 'Activité'
            ])
            ->add('turnover', null, [
                'required' => false,
                'label' => 'Chiffre d\'affaire'
            ])
            ->add('grossOperatingSurplus', null, [
                'required' => false,
                'label' => 'Excédent Brut d\'Exploitation (EBE)'
            ])
            ->add('profitBeforeInterestAndTaxes', null, [
                'required' => false,
                'label' => 'Bénéfice avant Intérêts et Impôts (EBIT)'
            ])
            ->add('treasury', null, [
                'required' => false,
                'label' => 'Trésorerie'
            ])
            ->add('financialDebt', null, [
                'required' => false,
                'label' => 'Endettement Financier'
            ])
            ->add('siren', null, [
                'required' => false,
                'label' => 'Numéro SIREN'
            ])
            ->add('phoneNumber', null, [
                'required' => false,
                'label' => 'Numéro de téléphone'
            ])
            ->add('contactEmail', null, [
                'required' => false,
                'label' => 'Email'
            ])
            ->add('website', null, [
                'required' => false,
                'label' => 'Site Web'
            ])
            ->add('dateCreation', DatePickerType::class, [
                'required' => false,
                'label' => 'Date de création de la société'
            ])
            ->add('dateTurnover', DatePickerType::class, [
                'required' => false,
                'label' => 'Date du Chiffre d\'affaire'
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
            ->with('Dirigeants', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-success'
            ])
            ->add('leaders', CollectionType::class, [
                'label' => false,
                'entry_type' => PersonType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false
            ])
            ->end()
            ->with('Spécialités', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-success'
            ])
            ->add('specialties', CollectionType::class, [
                'label' => false,
                'entry_type' => SpecialtyType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false
            ])
            ->end()
            ->with('Implantations', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-success'
            ])
            ->add('implantations', CollectionType::class, [
                'label' => false,
                'entry_type' => ImplantationType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false
            ])
            ->end()
            ->with('Opérations', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-success'
            ])
            ->add('operations', CollectionType::class, [
                'label' => false,
                'entry_type' => OperationType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false
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
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('investmentFund')
            ->add('parentCompany')
            ->add('holding')
            ->add('sector')
            ->add('age')
            ->add('activity')
            ->add('turnover')
            ->add('grossOperatingSurplus')
            ->add('profitBeforeInterestAndTaxes')
            ->add('treasury')
            ->add('financialDebt')
            ->add('siren')
            ->add('phoneNumber')
            ->add('contactEmail')
            ->add('website')
            ->add('dateCreation')
            ->add('dateTurnover')
            ->add('createdAt')
            ->add('updatedAt')
            ;
    }
}
