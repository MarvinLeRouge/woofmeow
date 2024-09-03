<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('species')
            ->add('breed')
            ->add('sex')
            ->add('sterilized')
            ->add('tattoo')
            ->add('chipNumber')
            ->add('birthDate', null, [
                'widget' => 'single_text',
            ])
            ->add('deathDate', null, [
                'widget' => 'single_text',
            ])
            ->add('nextVisitDate', null, [
                'widget' => 'single_text',
            ])
            ->add('owner', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
