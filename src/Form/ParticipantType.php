<?php

namespace App\Form;

use App\Entity\Participant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('picture', FileType::class, [
             'required' => false
            ])
            ->add('firstname')
            ->add('lastname')
            ->add('username')
            ->add('password')
            ->add('email')
            ->add('type')
            ->add('societe')
            ->add('poste')
            ->add('telephone')
            ->add('biographie', TextareaType::class, [])
            ->add('tweeterLink')
            ->add('linkedinLink')
            ->add('telephone2')
            ->add('enabled')
            //information vol
            ->add('dateDepart', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['placeholder' => 'dd-mm-yy'],
                'required' => false
            ])
            ->add('dateArrive', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['placeholder' => 'dd-mm-yy'],
                'required' => false
            ])
            ->add('numVolArrive')
            ->add('numVolDepart')
            ->add('nationalite')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
