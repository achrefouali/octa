<?php

namespace App\Form;

use App\Entity\Hotel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class HotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('description')
            ->add('services')
            ->add('adresse')
            ->add('categorie', ChoiceType::class, [
               'choices' => [
                    '3' => '3',
                    '3+' => '3+',
                    '4' => '4',
                    '4+' => '4+',
                    '5' => '5'
               ]
            ])
            ->add('longitude')
            ->add('latitude')
            ->add('enabled')
            ->add('ville')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class,
        ]);
    }
}
