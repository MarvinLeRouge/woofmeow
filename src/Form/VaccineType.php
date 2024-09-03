<?php

namespace App\Form;

use App\Entity\Vaccine;
use App\Entity\Visit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VaccineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('batchNumber')
            ->add('report')
            ->add('nextShotDate', null, [
                'widget' => 'single_text',
            ])
            ->add('visit', EntityType::class, [
                'class' => Visit::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vaccine::class,
        ]);
    }
}
