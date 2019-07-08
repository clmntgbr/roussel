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
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ArticleAdmin extends AbstractAdmin
{

    public function preUpdate($entity)
    {
        assert($entity instanceof Article);
        $entity->setTimeToRead();
        $uploader = $this->getConfigurationPool()->getContainer()->get('app.util.uploader');
        $media = $uploader->upload($entity->getFile(), $entity->getPreview(), 'images', 'articles');
        if($media instanceof Media) {
            $entity->setPreview($media);
        }
    }

    public function prePersist($entity)
    {
        assert($entity instanceof Article);
        $entity->setTimeToRead();
        $uploader = $this->getConfigurationPool()->getContainer()->get('app.util.uploader');
        $media = $uploader->upload($entity->getFile(), $entity->getPreview(), 'images', 'articles');
        if($media instanceof Media) {
            $entity->setPreview($media);
        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('title', null, [
                'label' => 'Titre'
            ])
            ->add('type', null, [
                'label' => 'Type de l\'article'
            ]);
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
                'label' => 'Titre de l\'article',
                'required' => false
            ])
            ->add('content', CKEditorType::class, [
                'label' => 'Contenu de l\'article',
                'required' => false
            ])
            ->add('type', null, [
                'label' => 'Type de l\'article',
                'required' => false
            ])
            ->add('timeToRead', null, [
                'label' => 'Temps de lecture (minutes)',
                'required' => false,
                'disabled' => true
            ])
            ->add('file', FileType::class, $fileFieldOptions)
            ->end();
    }
}
