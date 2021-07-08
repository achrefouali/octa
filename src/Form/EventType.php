<?php

namespace App\Form;

use App\Entity\Document;
use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $required=true ; 
        if(!is_null($options['data']->getId())){
            $required = false ; 
        }

        $builder
            ->add('logo', FileType::class, ['required' => $required,'mapped' => false])

            ->add('logoFacture', FileType::class, ['required' => $required,'mapped' => false])
            ->add('programFile', FileType::class, ['required' => false,'label'=>'Programme','mapped' => false])
              ->add('excursion', FileType::class, ['required' => false,'label'=>'Excursion','mapped' => false])
            ->add('brochureFile', FileType::class, ['required' => false,'label'=>'Brochure','mapped' => false])
            ->add('designation')
            ->add('designationEn')
            ->add('designation2')
            ->add('designation2En')
            ->add('pays')
            ->add('ville')
            ->add('adresse')
            ->add('longitude')
            ->add('latitude')
            ->add('description', TextareaType::class, [
                'required'=>true ])
            ->add('descriptionEn', TextareaType::class, [
                'required'=>true])
            ->add('keywords')
            ->add('metadescription')
            ->add('facebookLink')
            ->add('googleLink')
            ->add('tweeterLink')
            ->add('instagramLink')
            ->add(
                'dateDebut',
                DateType::class,
                [
                    'widget' => 'single_text',
                ]
            )
            ->add(
                'dateFin',
                DateType::class,
                [
                    'widget' => 'single_text',
                ]
            )
            ->add(
                'documents',
                CollectionType::class,
                [
                    'entry_type'    => DocumentType::class,
                    'entry_options' => [
                        'attr' => ['class' => 'document-box'],
                    ],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'delete_empty' => function (Document $document = null) {
                        return null === $document || empty($document->getFile());
                    },
                    'required' => false
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Event::class,
            ]
        );
    }
}
