<?php

namespace App\Form;

use App\Entity\Teams;
use App\Entity\Members;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('members', CollectionType::class, [
                'entry_type' => EntityType::class,
                'entry_options' => [
                    'class' => Members::class,
                    'choice_label' => function (Members $member) {
                        return $member->getName() . ' ' . $member->getLastName();
                    },
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Teams::class,
        ]);
    }
}
