<?php

namespace App\Form;

use App\Entity\Programme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Participant;

class ProgrammeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('designationEn')
            ->add('nbPlacesDisponibles')
            ->add('emplacement')
            ->add('intervenants', EntityType::class, [
                'class' => Participant::class,
                 'multiple' => true,
                 'expanded' => false,
                'preferred_choices' => function($participant, $key, $value) {
                    return $participant->getType()->getLabel() == 'Intervenant';
                },
            ])
            ->add('inscriptionActive')
            ->add('description')
            ->add('descriptionEn')
            ->add('heureDebut', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
                'placeholder' => array(
                    'hour' => 'Heure', 'minute' => 'Minute', 'second' => 'Secondes',
                ),
                'html5' => false
            ])
            ->add('heureFin', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
                'placeholder' => array(
                    'hour' => 'Heure', 'minute' => 'Minute', 'second' => 'Secondes',
                ),
                'html5' => false
            ])
            ->add('enabled')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Programme::class,
        ]);
    }
}
