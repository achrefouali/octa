<?php

namespace App\Form\Front;

use App\Entity\Participant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'form.firstname',
                'required' => true,
                'translation_domain' => "front"
            ])
            ->add('lastname', TextType::class, [
                'label' => 'form.lastname',
                'required' => true,
                'translation_domain' => "front"
            ])
            ->add('email', EmailType::class, [
                'label' => 'form.email',
                'required' => true,
                'translation_domain' => "front"
            ])
            ->add('societe', TextType::class, [
                'label' => 'form.societe.label',
                'required' => false,
                'translation_domain' => "front"
            ])
            ->add('poste', TextType::class, [
                'label' => 'form.poste',
                'required' => false,
                'translation_domain' => "front"
            ])
            ->add('telephone', TextType::class, [
                'label' => 'form.telephone',
                'required' => true,
                'translation_domain' => "front"
            ])
            ->add('telephone2', TextType::class, [
                'label' => 'form.telephone2',
                'required' => true,
                'translation_domain' => "front"
            ])
            ->add('biographie', TextType::class, [
                'label' => 'form.biographie',
                'required' => true,
                'translation_domain' => "front"
            ])
            ->add('tweeterLink', TextType::class, [
                'label' => 'form.tweeterLink',
                'required' => true,
                'translation_domain' => "front"
            ])
            ->add('linkedinLink', TextType::class, [
                'label' => 'form.linkedinLink',
                'required' => true,
                'translation_domain' => "front"
            ])
         
            ->add('nationalite', TextType::class, [
                'label' => 'form.nationalite',
                'attr' => ['placeholder' => 'form.nationalite'],
                'required' => false,
                'translation_domain' => "front"
            ])

            ->add('address', TextType::class, [
                'label' => 'form.address',
                'attr' => ['placeholder' => 'form.address'],
                'required' => false,
                'translation_domain' => "front"
            ])
            ->add('codePostal', TextType::class, [
                'label' => 'form.codePostal',
                'attr' => ['placeholder' => 'form.codePostal'],
                'required' => false,
                'translation_domain' => "front"
            ])

            ->add('country', TextType::class, [
                'label' => 'form.country',
                'attr' => ['placeholder' => 'form.country'],
                'required' => false,
                'translation_domain' => "front"
            ])
            ->add('pays', EntityType::class, [
                'class' => 'App\Entity\Pays',
//                'label'=>'form.pays'
//                 'translation_domain' => "front"
            ])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array('translation_domain' => 'messages'),
                'first_options' => array('label' => 'form.password', 'translation_domain' => "front", 'attr' => array('class' => 'form-control', 'placeholder' => 'form.password')),
                'second_options' => array('label' => 'form.password_confirmation', 'translation_domain' => "front", 'attr' => array('class' => 'form-control', 'placeholder' => 'form.password_confirmation')),
                'invalid_message' => 'fos_user.password.mismatch',
                'attr' => array('class' => 'form-control')
            ))

;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
