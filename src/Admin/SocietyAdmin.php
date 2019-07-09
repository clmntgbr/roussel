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
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class SocietyAdmin extends AbstractAdmin
{
    public function getExportFields()
    {
        return ['id', 'name', 'parentCompany', 'activity', 'SpecialtiesExport', 'OperationsExport', 'turnover', 'getPostalCode', 'contactEmail', 'CreatedAtForExport', 'UpdatedAtForExport', 'CreatedByForExport'];
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id', null, [
                'label' => 'Id'
            ])
            ->add('name', null, [
                'label' => 'Nom'
            ])
            ->add('investmentFund', null, [
                'label' => 'Fond d\'investissement'
            ])
            ->add('parentCompany', null, [
                'label' => 'Société mère'
            ])
            ->add('holding', null, [
                'label' => 'Holding'
            ])
            ->add('sector', null, [
                'label' => 'Secteur'
            ])
            ->add('age', null, [
                'label' => 'Age'
            ])
            ->add('activity', null, [
                'label' => 'Activitée'
            ])
            ->add('turnover', null, [
                'label' => 'CA'
            ])
            ->add('grossOperatingSurplus', null, [
                'label' => 'Excédent Brut d\'Exploitation (EBE)'
            ])
            ->add('profitBeforeInterestAndTaxes', null, [
                'label' => 'Bénéfice avant Intérêts et Impôts (EBIT)'
            ])
            ->add('treasury', null, [
                'label' => 'Trésorerie'
            ])
            ->add('financialDebt', null, [
                'label' => 'Dette'
            ])
            ->add('siren', null, [
                'label' => 'SIREN'
            ])
            ->add('phoneNumber', null, [
                'label' => 'Numéro de téléphone'
            ])
            ->add('contactEmail', null, [
                'label' => 'Email'
            ])
            ->add('website', null, [
                'label' => 'Site Web'
            ])
            ->add('dateCreation', null, [
                'label' => 'Date de création de la société'
            ])
            ->add('dateTurnover', null, [
                'label' => 'Date CA'
            ])
            ->add('createdAt', null, [
                'label' => 'Date de création'
            ])
            ->add('createdBy', null, [
                'label' => 'Créateur'
            ])
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
            ->add('specialties', SpecialtyType::class, [
                'label' => 'Spécialitées',
                'associated_property' => 'name'
            ])
            ->add('operations', OperationType::class, [
                'label' => 'Opérations',
                'associated_property' => 'name'
            ])
            ->add('turnover', null, [
                'label' => 'Chiffre d\'affaire'
            ])
            ->add('getPostalCode', null, [
                'label' => 'Code Postal'
            ])
            ->add('contactEmail', null, [
                'label' => 'Email'
            ])
            ->add('createdAt', null, [
                'label' => 'Date de création',
                'format' => 'd/m/Y H:i:s'
            ])
            ->add('updatedAt', null, [
                'label' => 'Date de modification',
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
            ->add('createdBy', TextType::class, [
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
                'label' => 'Date de création de la société',
                'format' => 'dd/MM/yyyy'
            ])
            ->add('dateTurnover', DatePickerType::class, [
                'required' => false,
                'label' => 'Date du Chiffre d\'affaire',
                'format' => 'dd/MM/yyyy'
            ])
            ->end()
            ->with('Adresse', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-success'
            ])
            ->add('address', AddressType::class, [
                'label' => false,
                'required' => false
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
}
