<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Media;
use App\Entity\Transaction;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class TransactionAdmin extends AbstractAdmin
{
    public function getExportFields()
    {
        return ['id', 'TitleForExport', 'ContentForExport', 'company', 'DateForExport', 'city', 'CreatedAtForExport', 'UpdatedAtForExport', 'CreatedByForExport'];
    }

    public function preUpdate($entity)
    {
        assert($entity instanceof Transaction);
        $uploader = $this->getConfigurationPool()->getContainer()->get('app.util.uploader');
        $media = $uploader->upload($entity->getFile(), $entity->getPreview(), 'images', 'transactions');
        if($media instanceof Media) {
            $entity->setPreview($media);
        }
    }

    public function prePersist($entity)
    {
        assert($entity instanceof Transaction);
        $uploader = $this->getConfigurationPool()->getContainer()->get('app.util.uploader');
        $media = $uploader->upload($entity->getFile(), $entity->getPreview(), 'images', 'transactions');
        if($media instanceof Media) {
            $entity->setPreview($media);
        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id', null, [
                'label' => 'Id'
            ])
            ->add('company', null, [
                'label' => 'Société'
            ])
            ->add('title', null, [
                'label' => 'Titre'
            ])
            ->add('content', null, [
                'label' => 'Contenu'
            ])
            ->add('date', null, [
                'label' => 'Date'
            ])
            ->add('city', null, [
                'label' => 'Ville'
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
            ->add('title', 'html', [
                'label' => 'Titre'
            ])
            ->add('company', TextType::class, [
                'label' => 'Nom de la société'
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('date', 'date', [
                'label' => 'Date de la transaction',
                'format' => 'd/m/Y',
                'locale' => 'fr',
                'timezone' => 'Europe/Paris'
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
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $entity = $this->getSubject();
        assert($entity instanceof Transaction);

        $fileFieldOptions = [];
        if ($entity->getPreview() instanceof Media) {
            $container = $this->getConfigurationPool()->getContainer();
            $path = sprintf('%s/%s', $container->get('request_stack')->getCurrentRequest()->getBasePath(), $entity->getPreview()->getFile());
            $fileFieldOptions['data_class'] = Media::class;
            $fileFieldOptions['label'] = "Image de couverture";
            $fileFieldOptions['required'] = false;
            $fileFieldOptions['help'] = sprintf('<img src="%s" class="admin-preview"/>', $path);
        }

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
            ->add('file', FileType::class, $fileFieldOptions)
            ->end();
    }
}
