<?php

namespace App\Admin;

use App\Entity\Category;
use App\Entity\Institution;
use App\Repository\InstitutionRepository;
use App\Service\YandexGeocoderService;
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
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class PromotionAdmin extends AbstractAdmin
{
    public function __construct(
        private readonly InstitutionRepository $institutionRepository,
    ) {
        parent::__construct(); // добавлять code, class, controller не надо, тк это deprecated, соната сама их подставляет по тегу sonata.admin
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
                ->add('name', TextType::class)
                ->add('description', TextareaType::class, [
                    'attr' => ['rows' => 7],
                ])
                ->add('rules', TextareaType::class, [
                    'attr' => ['rows' => 7],
                ])
                ->add('category', EntityType::class, [
                    'class' => Category::class,
                ])
                ->add('institutions', EntityType::class, [
                    'multiple' => true,
                    'class'    => Institution::class,
                    'required' => false,
                    'data'     => $this->isCurrentRoute('edit')
                        ? $this->getSubject()->getInstitutions()
                        : $this->institutionRepository->findAll(),
                    'label' => 'form.label_institutions_for_promotion',
                ])
            ->end()
            ->with('media', ['class' => 'col-md-6'])
                ->add('image', MediaType::class, [
                    'required'      => false,
                    'new_on_update' => false, // чтобы можно было обновлять фото, не удаляя предыдущее

                    'provider' => 'sonata.media.provider.image',
                    'context'  => 'promotion',
                ])
            ->end()
            ->with('information', ['class' => 'col-md-6'])
                ->add('datePublication', DateType::class)
                ->add('startDate', DateType::class)
                ->add('endDate', DateType::class)
            ->end()
        ;

        $form->get('image')->remove('unlink');
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
            ->add('startDate', 'datetime', [
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
            ->add('rules')
            ->add('datePublication', 'datetime', [
                'format' => 'd.m.Y, H:i:s',
            ])
            ->add('category')
            ->add('institutions', null, [
                'label' => 'show.label_institutions_for_promotion',
            ])
            ->add('createdAt', 'datetime', [
                'format' => 'd.m.Y, H:i:s',
            ])
            ->add('updatedAt', 'datetime', [
                'format' => 'd.m.Y, H:i:s',
            ])
        ;
    }
}