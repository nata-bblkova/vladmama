<?php

namespace App\Admin;

use App\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class NewsAdmin extends AbstractAdmin
{
    protected function configureDefaultSortValues(array &$sortValues): void
    {
        $sortValues = [
            DatagridInterface::SORT_ORDER => 'DESC',
            DatagridInterface::SORT_BY    => 'createdAt',
        ];
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('general', ['class' => 'col-md-6'])
                ->add('name', TextType::class)
                ->add('description', TextareaType::class, [
                    'attr' => ['rows' => 7],
                ])
                ->add('category', EntityType::class, [
                    'class' => Category::class,
                ])
                ->add('datePublication', DateTimeType::class)
            ->end()
            ->with('media', ['class' => 'col-md-6'])
            ->add('image', MediaType::class, [
                'required'      => false,
                'new_on_update' => false, // чтобы можно было обновлять фото, не удаляя предыдущее

                'provider' => 'sonata.media.provider.image',
                'context'  => 'news',
            ])
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('id')
            ->add('name')
//            ->add('datePublication')
            ->add('category')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('name')
            ->add('image', 'image')
            ->add('description', FieldDescriptionInterface::TYPE_HTML, [
                'truncate' => [
                    'length' => 300
                ]
            ])
            ->add('datePublication', 'datetime', [
                'format' => 'd.m.Y',
            ])
            ->add('category')
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
            ->add('datePublication', 'datetime', [
                'format' => 'd.m.Y, H:i:s',
            ])
            ->add('category')
            ->add('createdAt', 'datetime', [
                'format' => 'd.m.Y, H:i:s',
            ])
            ->add('updatedAt', 'datetime', [
                'format' => 'd.m.Y, H:i:s',
            ])
        ;
    }
}