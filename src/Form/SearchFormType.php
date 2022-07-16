<?php

namespace App\Form;

use App\Data\SearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('localisation', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Localisation'
                ]
            ])
            ->add('superficieMin', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Superficie minimum',
                ]
            ])
            ->add('superficieMax', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Superficie maximum',
                ]
            ])
            ->add('prixMin', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prix minimum',
                ]
            ])
            ->add('prixMax', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prix maximum',
                ]
            ])
            ->add('type', ChoiceType::class, [
                'label' => false,
                'multiple' => true,
                'expanded' => true,
                'required' => true,
                'choices' => [
                    'Maison' => 'maison',
                    'Appartement' => 'appartement'
                ]
            ])
            // ->add('maison', CheckboxType::class, [
            //     'label' => 'Maison',
            //     'required' => false,
            //     'attr' => [
                    
            //     ]
            // ])
            // ->add('appartement', CheckboxType::class, [
            //     'label' => 'Appartement',
            //     'required' => false,
            //     'attr' => [
                    
            //     ]
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    /**
     * Permet d'obtenir un préfixe VIDE d'url lors de la recherche 
     * supprime le "?query=..."
     */
    public function getBlockPrefix()
    {
        return '';
    }
}
