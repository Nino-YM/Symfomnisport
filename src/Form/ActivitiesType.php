<?php

namespace App\Form;

use App\Entity\Activities;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Sections;
use App\Entity\Teams;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivitiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('section', EntityType::class, [
                'class' => Sections::class,
                'choice_label' => 'name',
                'placeholder' => 'Choose a section',
            ])
            ->add('teams', CollectionType::class, [
                'entry_type' => EntityType::class,
                'entry_options' => [
                    'class' => Teams::class,
                    'choice_label' => 'name',
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false, // Ensure no label is generated for CollectionType
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activities::class,
        ]);
    }
}
