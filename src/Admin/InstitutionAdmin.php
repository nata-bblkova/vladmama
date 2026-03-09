<?php

namespace App\Admin;

use App\Entity\Category;
use App\Form\Type\AddressType;
use App\Service\YandexGeocoderService;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class InstitutionAdmin extends AbstractAdmin
{
    public function __construct(
        private readonly YandexGeocoderService $yandexGeocoderService,
    ) {
        parent::__construct(); // добавлять code, class, controller не надо, тк это deprecated, соната сама их подставляет по тегу sonata.admin
    }

    protected function preUpdate(object $object): void
    {
        $this->updateCoordinates($object);
    }

    protected function prePersist(object $object): void
    {
        $this->updateCoordinates($object);
    }

    private function updateCoordinates(object $object): void
    {
        $coordinates = $this->yandexGeocoderService->getCoordinatesByAddress($object->getAddress());

        $object
            ->setLatitude($coordinates['latitude'])
            ->setLongitude($coordinates['longitude'])
        ;
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('general', ['class' => 'col-md-6'])
                ->add('name', TextType::class)
                ->add('description', TextareaType::class, [
                    'attr' => ['rows' => 7],
                ])
                ->add('address', AddressType::class)
                ->add('image', MediaType::class, [
                    'required'      => false,
                    'new_on_update' => false, // чтобы можно было обновлять фото, не удаляя предыдущее

                    'provider' => 'sonata.media.provider.image',
                    'context'  => 'institution',
                ])
            ->end()
            ->with('information', ['class' => 'col-md-6'])
                ->add('groups', CollectionType::class, [
                    'by_reference' => false,
                    'btn_translation_domain' => 'messages',
                ], [
                    'edit'       => 'inline',
                    'inline'     => 'table',
                    'admin_code' => GroupAdmin::class,
                ])
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('id')
            ->add('name')
            ->add('address')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('name')
            ->add('image', 'image')
            ->add('groups')
            ->add('description', FieldDescriptionInterface::TYPE_HTML, [
                'truncate' => [
                    'length' => 300
                ]
            ])
            ->add('address')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show'   => [],
                    'edit'   => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('description')
            ->add('address')
            ->add('groups')
            ->add('createdAt', 'datetime', [
                'format' => 'd.m.Y, H:i:s',
            ])
            ->add('updatedAt', 'datetime', [
                'format' => 'd.m.Y, H:i:s',
            ])
        ;
    }
}