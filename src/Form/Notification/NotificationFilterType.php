<?php

namespace App\Form\Notification;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Tests\Fixtures\Entity;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Description of FilterType
 *
 * @author air
 */
class NotificationFilterType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('subject', TextType::class, array('translation_domain' => 'ApplicationNotificationBundle',
                    'label' => 'notification.parameters.subject.label',                    
                    'required' => false,
                    'attr' => array('class' => 'form-control', 'placeholder' => 'notification.parameters.subject.placeholder', 'maxlength' => '250'),
                ))
                ->add('notificationType', ChoiceType::class, array('translation_domain' => 'ApplicationNotificationBundle',
                    'label' => 'notification.parameters.notificationType.label',
                    'placeholder' => 'notification.parameters.notificationType.placeholder',
                    'choices' => array_flip($options['notificationType']),
                    'choices_as_values' => true,
                    'expanded' => false,                    
                    'required' => false,
                    'attr' => array('class' => 'chosen-select form-control', 'tabindex' => '4'),
                ))

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
          $resolver->setDefaults(array(
            'data_class' => null,
            'notificationType' => array(),
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix() {
        return 'application_notification_filter_type';
    }

}
