<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Article;
use App\Entity\Media;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ArticlesAdmin extends AbstractAdmin
{

    public function preUpdate($entity)
    {
        assert($entity instanceof Article);
        $uploader = $this->getConfigurationPool()->getContainer()->get('app.util.uploader');
        $media = $uploader->upload($entity->getFile(), 'articles', $entity->getPreview());
        if($media instanceof Media) {
            $entity->setPreview($media);
        }
    }

    public function prePersist($entity)
    {
        assert($entity instanceof Article);
        $uploader = $this->getConfigurationPool()->getContainer()->get('app.util.uploader');
        $media = $uploader->upload($entity->getFile(), 'articles');
        if($media instanceof Media) {
            $entity->setPreview($media);
        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('title')
            ->add('type')
            ->add('content')
            ->add('timeToRead')
            ->add('createdAt')
            ->add('updatedAt')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('id')
            ->add('title', 'html', [
                'label' => 'Titre'
            ])
            ->add('type', TextType::class, [
                'label' => 'Type de l\'article'
            ])
            ->add('created_at', 'date', [
                'label' => 'Date de création',
                'locale' => 'fr',
                'timezone' => 'Europe/Paris',
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
        $entity = $this->getSubject();
        assert($entity instanceof Article);

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
            ->end()
            ->with('Général', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-success'
            ])
            ->add('title', CKEditorType::class, [
                'label' => 'Titre de l\'article'
            ])
            ->add('content', CKEditorType::class, [
                'label' => 'Contenu de l\'article'
            ])
            ->add('type', null, [
                'label' => 'Type de l\'article'
            ])
            ->add('file', FileType::class, $fileFieldOptions)
            ->end();
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('title')
            ->add('type')
            ->add('content')
            ->add('timeToRead')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('createdBy')
            ;
    }
}
