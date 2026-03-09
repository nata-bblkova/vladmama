<?php

namespace App\Admin;

use App\Entity\Category;
use App\Entity\Group;
use App\Entity\Institution;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ChildAdmin extends AbstractAdmin
{
    protected function configureDefaultSortValues(array &$sortValues): void
    {
        $sortValues = [
            DatagridInterface::SORT_ORDER => 'DESC',
            DatagridInterface::SORT_BY    => 'name',
        ];
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('general', ['class' => 'col-md-8'])
                ->add('name', TextType::class)
                ->add('desire', TextareaType::class, [
                    'attr' => ['rows' => 7],
                ])
            ->end()
            ->with('information', ['class' => 'col-md-4'])
                ->add('birthday', DateType::class)
                ->add('group', EntityType::class, [
                    'class' => Group::class,
                    'required' => false,
                ])
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('id')
            ->add('name')
            ->add('desire')
            ->add('group')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('name')
            ->add('desire')
            ->add('group')
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
            ->add('desire')
            ->add('birthday', 'datetime', [
                'format' => 'd.m.Y',
            ])
            ->add('group')
            ->add('createdAt', 'datetime', [
                'format' => 'd.m.Y, H:i:s',
            ])
            ->add('updatedAt', 'datetime', [
                'format' => 'd.m.Y, H:i:s',
            ])
        ;
    }
}