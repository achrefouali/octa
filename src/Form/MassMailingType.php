<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Participant;
use App\Entity\Notification;

class MassMailingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('notification', EntityType::class, [
                'label' => 'Notifications*',
                'class' => Notification::class,
                'required' => true
            ])
            ->add('participants', EntityType::class, [
                'label' => 'Participants',
                'group_by' => 'type',
                'class' => Participant::class,
                'multiple' => true,
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'validation_groups' => ['registration']
        ]);
    }
}
