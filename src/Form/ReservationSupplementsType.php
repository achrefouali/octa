<?php

namespace App\Form;

use App\Entity\ReservationSupplements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReservationSupplementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('total')
            ->add('enabled')
            ->add('supplements')
            ->add('paymentMethod', ChoiceType::class, [
                'choices' => array_flip($options['paymentMethods']),
                'choices_as_values' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ReservationSupplements::class,
            'paymentMethods' => []
        ]);
    }
}
