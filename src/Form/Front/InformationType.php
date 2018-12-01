<?php

namespace App\Form\Front;

use App\Entity\Pays;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
        
    {
        $array=range(0,100,1);
//        dump($array);exit;
//        $array = array_filter(array_merge(array(0), $array));

        $organisme=$options['organisme'];
        
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'form.firstname',
                'attr' => ['placeholder' => 'form.firstname'],
                'required' => true,
                'translation_domain' => "front"
            ])
            ->add('lastname', TextType::class, [
                'label' => 'form.lastname',
                'attr' => ['placeholder' => 'form.lastname'],
                'required' => true,
                'translation_domain' => "front"
            ])
            ->add('email', RepeatedType::class, array(
                'type' => EmailType::class,
                'first_options' => array('label' => 'form.email', 'translation_domain' => "front", 'attr' => array('class' => 'form-control', 'placeholder' => 'form.email')),
                'second_options' => array('label' => 'form.email_confirmation', 'translation_domain' => "front", 'attr' => array('class' => 'form-control', 'placeholder' => 'form.email_confirmation')),
                'invalid_message' => 'E-mail Mismatch',
                'translation_domain' => "front",
                'attr' => array('class' => 'form-control')
            ))
            
           
            ->add('poste', TextType::class, [
                'label' => 'form.poste',
                'attr' => ['placeholder' => 'form.poste'],
                'required' => true,
                'translation_domain' => "front"
            ])
            ->add('telephone', TextType::class, [
                'label' => 'form.telephone',
                'attr' => ['placeholder' => '(+000) 00 00 00'],
                'required' => true,
                'translation_domain' => "front"
            ])
//information vol
            ->add('dateArrive', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['placeholder' => 'dd-mm-yy'],
                'label' => 'form.dateArrive',
                'required' => false,
                'html5' => false,
                'translation_domain' => "front",
                'format' => 'dd-MM-yyyy',
            ])
            ->add('dateDepart', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['placeholder' => 'dd-mm-yy'],
                'label' => 'form.dateDepart',
                'required' => false,
                'html5' => false,
                'translation_domain' => "front",
                'format' => 'dd-MM-yyyy',
            ])
            ->add('numVolArrive', TextType::class, [
                'label' => 'form.numVolArrive',
                'attr' => ['placeholder' => 'form.numVolArrive'],
                'required' => false,
                'translation_domain' => "front"
            ])
            ->add('numVolDepart', TextType::class, [
                'label' => 'form.numVolDepart',
                'attr' => ['placeholder' => 'form.numVolDepart'],
                'required' => false,
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
            ->add('heureArrival', TimeType::class, [
                'label' => 'form.heureArrival',
                'attr' => ['placeholder' => 'form.heureArrival'],
                'required' => false,
                'translation_domain' => "front"
            ])
            ->add('heureDeparture', TimeType::class, [
                'label' => 'form.heureDeparture',
                'attr' => ['placeholder' => 'form.heureDeparture'],
                'required' => false,
                'translation_domain' => "front"
            ])
            ->add('pays', EntityType::class, [
                'class' => 'App\Entity\Pays',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                'placeholder'=>'Choisir un pays'
               
//                'label'=>'form.pays'
//                 'translation_domain' => "front"
            ])
          
            ->add('tarif', TextType::class, [
                'label' => 'form.tarif',
                'attr' => ['placeholder' => 'form.tarif','readonly' => true],
                'data'=>$options['tarifPriceAccompagnants'],
                'required' => false,
                'mapped' => false,

                'translation_domain' => "front"
            ])
            

            ->add('nbAccompanying', ChoiceType::class, [
                'label' => 'form.nbAccompanying',
                'choices' => array_flip($array),
                'choice_label'       => function ($item, $value) {
                    return $value;
                },
                'placeholder' => 'form.nbAccompanying',
                'required' => false,
                'translation_domain' => "front"
            ])

           

            ;

         if(empty($organisme)){
            $builder ->add('societe', TextType::class, [
                 'label' => 'form.societe.label',
                 'attr' => ['placeholder' => 'form.societe.placeholder'],
                'required' => true,
                 'translation_domain' => "front"
             ]);
         }else{
             $builder

                 ->add('societe', ChoiceType::class, [
                 'label' => 'form.societe.label',
                     'choices' => array_flip($organisme),
                     'choice_label'       => function ($item, $value) {
                         return $value;
                     },
                     'placeholder' => 'form.societe.placeholder',
                 'required' => true,
                 'translation_domain' => "front"
             ]);
         }
        $builder

            ->add('hotel', EntityType::class, [
                'class' => 'App\Entity\Hotel',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.designation', 'ASC');
                },
                'required'=>false,
                'placeholder'=>'Choisir un hotel'

//                'label'=>'form.pays'
//                 'translation_domain' => "front"
            ]);

       
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            'organisme'=>[],
            'tarifPriceAccompagnants'=>null,
            
        ]);
    }
}
