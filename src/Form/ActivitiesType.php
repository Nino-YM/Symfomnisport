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
            ->add('team', EntityType::class, [
                'class' => Teams::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'placeholder' => 'Choose teams',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activities::class,
        ]);
    }
}
