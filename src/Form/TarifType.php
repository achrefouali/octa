<?php

namespace App\Form;

use App\Entity\Tarif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TarifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('event')
            ->add('label')
            ->add('prix')
            ->add('prixAccompagnant')
            ->add('enabled')

            ->add('visible', null, [
                'label' => 'Afficher prix',
                'translation_domain' => "front"

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tarif::class,
        ]);
    }
}
