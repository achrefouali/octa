<?php

namespace App\Form;

use App\Entity\ReservationHotel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReservationHotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $participant=$options['participant'];
        $reservation=$options['reservation'];
        $state=$options['state'];
        $builder


            ->add('firstname', TextType::class, [
                'attr' => [ 'diseabled' => true,
                    'readonly' => true],
                'mapped'=>false,
                'data'=>$participant->getFirstname(),

                'label' => 'form.firstname',
                'translation_domain' => "front"

            ])
            ->add('lastname', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=>$participant->getLastname(),
                'mapped'=>false,
                'label' => 'form.lastname',
                'translation_domain' => "front"

            ])
            ->add('societe', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=>$participant->getSociete(),
                'mapped'=>false,
                'label' => 'form.societe',
                'translation_domain' => "front"
            ])
            ->add('telephone', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=>$participant->getTelephone(),
                'mapped'=>false,
                'label' => 'form.telephone',
                'translation_domain' => "front"
            ])

            ->add('email', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=>$participant->getEmail(),
                'mapped'=>false,
                'label' => 'form.email',
                'translation_domain' => "front"
            ])
            ->add('nationalite', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=>$participant->getNationalite(),
                'mapped'=>false,
                'label' => 'form.nationalite',
                'translation_domain' => "front"
            ])

            ->add('poste', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=>$participant->getPoste(),
                'mapped'=>false,
                'label' => 'form.poste',
                'translation_domain' => "front"
            ])
            ->add('dateArrive', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=>!is_null($reservation->getDateArrive())?$reservation->getDateArrive()->format('Y-m-d'):'',
                'mapped'=>false,
                'label' => 'form.dateArrive',
                'translation_domain' => "front"
            ]) ->add('dateDepart', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=> !is_null($reservation->getDateDepart())?$reservation->getDateDepart()->format('Y-m-d'):'',
                'mapped'=>false,
                'label' => 'form.dateDepart',
                'translation_domain' => "front"
            ])
            ->add('numVolArrive', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=>$reservation->getNumVolArrive(),
                'mapped'=>false,
                'label' => 'form.numVolArrive',
                'translation_domain' => "front"
            ])
            ->add('numVolDepart', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=>$reservation->getNumVolDepart(),
                'mapped'=>false,
                'label' => 'form.numVolDepart',
                'translation_domain' => "front"
            ])
            ->add('address', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=>$participant->getAddress(),
                'mapped'=>false,
                'label' => 'form.address',
                'translation_domain' => "front"
            ])
            ->add('codePostal', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=>$participant->getCodePostal(),
                'mapped'=>false,
                'label' => 'form.codePostal',
                'translation_domain' => "front"
            ])
            ->add('country', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=>$participant->getCountry(),
                'mapped'=>false,
                'label' => 'form.country',
                'translation_domain' => "front"
            ])
            ->add('heureDeparture', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=>!is_null($reservation->getHeureDeparture())?$reservation->getHeureDeparture()->format('H:i:s'):'',
                'mapped'=>false,
                'label' => 'form.heureDeparture',
                'translation_domain' => "front"
            ])
            ->add('heureArrival', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=>!is_null($reservation->getHeureArrival())?$reservation->getHeureArrival()->format('H:i:s'):'',
                'mapped'=>false,
                'label' => 'form.heureArrival',
                'translation_domain' => "front"
            ])
            ->add('pays', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=>$participant->getPays()->getName(),
                'mapped'=>false,

            ])
            ->add('code', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],

            ])
            ->add('total')
            ->add('receivedAmout', TextType::class, [
                'label' => 'form.receivedAmout',
                'required'=>false,
                'translation_domain' => "front"
            ])
            ->add('nbJours')
            ->add('paymentMethod', ChoiceType::class, [
                'choices' => array_flip($options['paymentMethods']),
                'choices_as_values' => true,
            ])
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('enabled')
            ->add('hotel')
            ->add('state', TextType::class, [
                'attr' => [ 'diseabled' => true,

                    'readonly' => true],
                'data'=>$state,
                'mapped'=>false,

            ])

            ->add('paiementType', ChoiceType::class, [
                'choices' => array_flip($options['paymentType']),
                'choices_as_values' => true,
                'required'=>false,
                'attr'=>['placeholder'=>'choisir un type de paiement'],
                'label' => 'form.paiementType',
                'translation_domain' => "front"
            ])

            ->add('datePaiement', DateType::class, [
                'widget' => 'single_text',
                'label' => 'form.datePaiement',
                'required'=>false,
                'translation_domain' => "front"
            ])

            ->add('obsPaiement', TextType::class, [
                'label' => 'form.obsPaiement',
                'required'=>false,
                'translation_domain' => "front"
            ])
            ->add('operator', TextType::class, [
                'label' => 'form.operator',
                'required'=>false,
                'translation_domain' => "front"
            ])

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ReservationHotel::class,
            'paymentMethods' => [],
            'participant' => null,
            'reservation' => null,
            'state' => null,
            'paymentType' => null,
        ]);
    }
}
