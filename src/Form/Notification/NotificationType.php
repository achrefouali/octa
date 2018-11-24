<?php

namespace App\Form\Notification;

use App\Entity\Notification;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NotificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('notificationType', ChoiceType::class, array('translation_domain' => 'AppNotification',
                'label' => 'notification.parameters.notificationType.label',
                'placeholder' => 'notification.parameters.notificationType.placeholder',
                'choices' => array_flip($options['notificationType']),
                'expanded' => false,
                'choices_as_values' => true,
                'required' => false,
                'disabled' => false,
                'attr' => array('class' => 'form-control'),
            ))
            ->add('subject', TextType::class, array('translation_domain' => 'AppNotification',
                'label' => 'notification.parameters.subject.label',
                'disabled' => false,
                'attr' => array('class' => 'form-control', 'placeholder' => 'notification.parameters.subject.placeholder', 'maxlength' => '250')
            ))
            ->add('pattern', EntityType::class, array(
                'label' => 'notification.parameters.pattern.label',
                'class' => 'App:Pattern',
                'choices'=> $options['patterns'],
                'translation_domain' => 'AppNotification',
                'choice_translation_domain' => true,
                'multiple' => true,
                'required' => false,
                'mapped' =>false,
                'attr' => array('class' => 'form-control', 'style' => 'min-height:500px !important;','placeholder' => 'notification.parameters.pattern.placeholder'),


            ))
            ->add('description', null, array('translation_domain' => 'AppNotification',
                'label' => 'notification.parameters.description.label',
                'disabled' => false,
                'attr' => array('class' => 'form-control', 'style' => 'min-height:500px !important;', 'placeholder' => 'notification.parameters.description.placeholder')
            ))

            ->add('enabled')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Notification::class,
            'notificationType' => [],
            'patterns' => [],
        ]);
    }
}
