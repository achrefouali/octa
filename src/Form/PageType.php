<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('menu')
            ->add('title')
            ->add('title_en')
            ->add('summary')
            ->add('summary_en')
            ->add('content_en',null, array(
                'attr' => array(
                    'class' => 'ckeditor'
                ),
            ))
            ->add('content',null, array(
                'attr' => array(
                    'class' => 'ckeditor'
                ),
            ))
            ->add('enabled');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Page'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_page';
    }


}
