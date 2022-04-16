<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApiSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Title'
                ],
                'required' => false
            ])
            ->add('year', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Year'
                ],
                'required' => false
            ])
            ->add('director', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Director'
                ],
                'required' => false
            ])
            ->add('actor', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Actor'
                ],
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
