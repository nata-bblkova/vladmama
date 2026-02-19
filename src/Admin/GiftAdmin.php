<?php

namespace App\Admin;

use App\Entity\Child;
use App\Entity\Promotion;
use App\Entity\User;
use App\Enum\GiftStatusEnum;
use App\Repository\InstitutionRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class GiftAdmin extends AbstractAdmin
{
    public function __construct(InstitutionRepository $institutionRepository, ?string $code = null, ?string $class = null, ?string $baseControllerName = null)
    {
        parent::__construct($code, $class, $baseControllerName);
    }

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
                ->add('description', TextareaType::class, [
                    'attr' => ['rows' => 3],
                ])
                ->add('promotion', EntityType::class, [
                    'class' => Promotion::class,
                ])
                ->add('child', EntityType::class, [
                    'class' => Child::class,
                ])
            ->end()
            ->with('information', ['class' => 'col-md-6'])
                ->add('giftStatusEnum', EnumType::class,[
                    'class' => GiftStatusEnum::class,
                ])
                ->add('user', EntityType::class, [
                    'class' => User::class,
                    'required' => false,
                ])
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('id')
            ->add('giftStatusEnum')
            ->add('promotion')
            ->add('child')
            ->add('user')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('description', FieldDescriptionInterface::TYPE_HTML, [
                'truncate' => [
                    'length' => 300
                ]
            ])
            ->add('giftStatusEnum', 'enum', [
                'enum_translation_domain' => 'messages',
            ])
            ->add('promotion')
            ->add('child')
            ->add('user')
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
            ->add('description')
            ->add('giftStatusEnum', 'enum', [
                'enum_translation_domain' => 'messages',
            ])
            ->add('promotion')
            ->add('child')
            ->add('user')
            ->add('createdAt', 'datetime', [
                'format' => 'd.m.Y, H:i:s',
            ])
            ->add('updatedAt', 'datetime', [
                'format' => 'd.m.Y, H:i:s',
            ])
        ;
    }
}