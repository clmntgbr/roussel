<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Media;
use App\Entity\User;
use App\Util\Security;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DatePickerType;
use Sonata\Form\Validator\ErrorElement;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class UserAdmin extends AbstractAdmin
{
    /** @var Security */
    private $security;

    public function __construct($code, $class, $baseControllerName, Security $security)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->security = $security;
    }

    public function getExportFields()
    {
        return ['id', 'email', 'CreatedAtForExport', 'UpdatedAtForExport'];
    }

    public function preUpdate($entity)
    {
        assert($entity instanceof User);

        $uploader = $this->getConfigurationPool()->getContainer()->get('app.util.uploader');
        $media = $uploader->upload($entity->getFile(), $entity->getAvatar(), 'images', 'users');
        if($media instanceof Media) {
            $entity->setAvatar($media);
        }

        if($entity->getOldPassword() !== null && $entity->getNewPassword() !== null) {
            $newPassword = json_decode(json_encode($entity), true)['newPassword'];
            $oldPassword = json_decode(json_encode($entity), true)['oldPassword'];
            $this->security->changePassword($entity, $oldPassword, $newPassword);
        }

    }

    public function prePersist($entity)
    {
        assert($entity instanceof User);
        $uploader = $this->getConfigurationPool()->getContainer()->get('app.util.uploader');
        $media = $uploader->upload($entity->getFile(), $entity->getAvatar(), 'images', 'users');
        if($media instanceof Media) {
            $entity->setAvatar($media);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validate(ErrorElement $errorElement, $object) {
        assert($object instanceof User);
        if ($object->getOldPassword() === null && $object->getNewPassword() !== null) {
            $errorElement->with('oldPassword')->addViolation('You need to provide the current password for changing it.')->end();
            return;
        }

        if ($object->getOldPassword() !== null) {
            if(!($this->security->passwordIsCurrent($object, $object->getOldPassword()))) {
                $errorElement->with('oldPassword')->addViolation('password is not valid.')->end();
                return;
            }
        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('username')
            ->add('usernameCanonical')
            ->add('email')
            ->add('emailCanonical')
            ->add('enabled')
            ->add('salt')
            ->add('password')
            ->add('lastLogin')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('id')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('id')
            ->add('username')
            ->add('email')
            ->add('enabled', null, [
                'label' => 'Actif'
            ])
            ->add('lastLogin', null, [
                'label' => 'Dernière connexion',
                'format' => 'd/m/Y H:i:s'
            ])
            ->add('roles')
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
        assert($entity instanceof User);

        $fileFieldOptions = [];
        if ($entity->getAvatar() instanceof Media) {
            $container = $this->getConfigurationPool()->getContainer();
            $path = sprintf('%s/%s', $container->get('request_stack')->getCurrentRequest()->getBasePath(), $entity->getAvatar()->getFile());
            $fileFieldOptions['data_class'] = Media::class;
            $fileFieldOptions['label'] = "Avatar";
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
            ->add('username', null, [
                'disabled' => true,
                'required' => false
            ])
            ->add('usernameCanonical', null, [
                'disabled' => true,
                'required' => false
            ])
            ->add('email', null, [
                'disabled' => true,
                'required' => false
            ])
            ->add('emailCanonical', null, [
                'disabled' => true,
                'required' => false
            ])
            ->add('enabled')
            ->add('lastLogin', DatePickerType::class, [
                'format' => 'dd/MM/yyyy, H:mm:ss',
                'disabled' => true
            ])
            ->add('roles')
            ->add('file', FileType::class, $fileFieldOptions)
            ->end()
            ->with('Password', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-success'
            ])
            ->add('newPassword', PasswordType::class, [
                'required' => false
            ])
            ->add('oldPassword', PasswordType::class, [
                'required' => false
            ])
            ->end()
            ->with('Configuration', [
                'class' => 'col-xs-12',
                'box_class' => 'box box-solid box-success'
            ])
            ->add('surname')
            ->add('resume')
            ->add('work')
            ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('username')
            ->add('usernameCanonical')
            ->add('email')
            ->add('emailCanonical')
            ->add('enabled')
            ->add('salt')
            ->add('password')
            ->add('lastLogin')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('id')
            ;
    }
}
