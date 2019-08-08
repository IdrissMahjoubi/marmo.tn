<?php

namespace FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MailerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('subject',TextareaType::class,['label' => false,'translation_domain' => 'FrontBundle','attr' => ['placeholder' => 'front_header.help']])
            ->add('mail',EmailType::class,['label' => false,'translation_domain' => 'FrontBundle','attr' => ['placeholder' => 'front_header.email']])
            ->add('object',TextType::class,['label' => false,'translation_domain' => 'FrontBundle','attr' => ['placeholder' => 'front_header.name']]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontBundle\Entity\Mailer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'frontbundle_mailer';
    }


}
