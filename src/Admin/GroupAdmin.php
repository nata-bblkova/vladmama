<?php

namespace App\Admin;

use App\Entity\Category;
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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class GroupAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('name', TextType::class)
            ->add('description', TextareaType::class, [
                'attr' => ['rows' => 3],
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('description')
            ->add('institution')
            ->add('createdAt', 'datetime', [
                'format' => 'd.m.Y, H:i:s',
            ])
            ->add('updatedAt', 'datetime', [
                'format' => 'd.m.Y, H:i:s',
            ])
        ;
    }
}