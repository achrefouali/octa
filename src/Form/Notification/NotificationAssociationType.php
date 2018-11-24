<?php

namespace App\Form\Notification;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\Notification\PatternType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NotificationAssociationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('notificationType', ChoiceType::class, array('translation_domain' => 'ApplicationNotificationBundle',
                    'label' => 'notification.parameters.notificationType.label',
                    'placeholder' => 'notification.parameters.notificationType.placeholder',
                    'choices' => array_flip($options['notificationType']),
                    'expanded' => false,
                    'choices_as_values' => true,
                    'required' => false,
                    'disabled' => true,
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('subject', TextType::class, array('translation_domain' => 'ApplicationNotificationBundle',
                    'label' => 'notification.parameters.subject.label',
                    'disabled' => false,
                    'label_attr' => array('class' => 'col-sm-12 control-label', 'placeholder' => 'notification.parameters.subject.placeholder'),
                    'attr' => array('class' => 'form-control')
                ))
                ->add('pattern', null, array(
                    'multiple' => true,
                    //'required' => $options['require'],
                    //'disabled'=> $options['Authorization'],
                    'attr' => array('class' => 'form-control multiselect', 'style' => 'margin: 0px auto;'),
                    'label' => 'notification.parameters.pattern.label', 'translation_domain' => 'ApplicationNotificationBundle'
                ))
                


        ;
    }

    public function getBlockPrefix() {
        return 'application_notification_association_pattern';
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Notification',
            'notificationType' => array(),
            'patterns' => array(),
        ));
    }

}
