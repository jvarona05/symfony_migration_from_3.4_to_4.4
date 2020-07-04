<?php

namespace CarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use CarBundle\Entity\Company;
use CarBundle\Entity\Model;
use Symfony\Component\Validator\Constraints\NotBlank;

class CarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('description', TextareaType::class, [
            'required' => true,
            'constraints' => [
                new NotBlank()
            ]
        ])
        ->add('price', TextType ::class, [
            'required' => true,
            'constraints' => [
                new NotBlank()
            ]
        ])
        ->add('year', TextType ::class, [
            'required' => true,
            'constraints' => [
                new NotBlank()
            ]
        ])
        ->add('navigation')
        ->add('company', EntityType::class, [
            'required' => true,
            'class' => Company::class
        ])
        ->add('model', EntityType::class, [
            'required' => true,
            'class' => Model::class
        ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CarBundle\Entity\Car'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'carbundle_car';
    }


}
