<?php

namespace FrontBundle\Form;

use FrontBundle\Entity\Image;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalleryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name',TextType::class,array('data_class' => null))
            ->add('name2',TextType::class,array('data_class' => null,'required' => false))
            ->add('image', ImageType::class,array('required' => false,'allow_extra_fields'=>true))
            ->add('filter',ChoiceType::class,array('data_class' => null,'choices' => array(
                'sculpture' => 'sculpture',
                'finition' => 'finition',
                'revetement' => 'revetement',
                'matiere premiere' => 'premiere',
                'Autre' => 'autre'),'data' => 'none'))
            ->add('description',TextareaType::class,array('data_class' => null))
            ->add('description2',TextareaType::class,array('data_class' => null,'required' => false))
            ->add('realisation',EntityType::class,array(
                'class'=>'FrontBundle:Realisation',
                'multiple'=>false,
                'choice_label'=> 'name',
                'required'=>false));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontBundle\Entity\Gallery'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'FrontBundle_gallery';
    }


}
