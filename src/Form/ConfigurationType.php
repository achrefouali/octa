<?php

namespace App\Form;

use App\Entity\Configuration;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('logo', FileType::class)
            ->add('pays', EntityType::class, [
               'class' => 'App\Entity\Pays'
            ])
            ->add('ville')
            ->add('adresse')
            ->add('nomExpediteur')
            ->add('emailExpediteur')
            ->add('telephone')
            ->add('fax')
            ->add('emailDirection')
            ->add('emailDirection2')
            ->add('emailAgence')
            ->add('banque')
            ->add('agence')
            ->add('numCompteBancaire')
            ->add('codeSwift')
            ->add('codeIban')
        ;


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Configuration::class
        ]);
    }
}
