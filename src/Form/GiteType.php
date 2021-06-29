<?php

namespace App\Form;

use App\Entity\Gite;
use App\Entity\Service;
use App\Entity\Equipement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class GiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => false,
                'label' => 'Nom du gite',
                'attr' => [
                    'placeholder' => 'Entrer le nom du gite'
                ]
            ])
            ->add('price', IntegerType::class, [
                'required' => false,
                'label' => 'Prix du gite',
                'attr' => [
                    'placeholder' => 'Entrer le prix du gite'
                ]
            ])
            ->add('imageFile', FileType::class, [
                'required' => false,
                'label' => 'Image du gite',
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Votre description idéal'
                ]
            ])
            ->add('surface', NumberType::class, [
                'required' => false,
                'label' => 'Surface',
                'attr' => [
                    'placeholder' => 'La surface du gite'
                ]
            ])
            ->add('bedrooms', NumberType::class, [
                'required' => false,
                'label' => 'Nombre de chambre',

            ])
            ->add('address', TextType::class, [
                'required' => false,
                'label' => 'Adresse',
                'attr' => [
                    'placeholder' => 'Adresse du gite'
                ]
            ])
            ->add('city', TextType::class, [
                'required' => false,
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Ville du gite'
                ]
            ])
            ->add('postal_code', TextType::class, [
                'required' => false,
                'label' => 'Code Postal',
                'attr' => [
                    'placeholder' => 'Code Postal du gite'
                ]
            ])
            ->add('animals', CheckboxType::class, [
                'required' => false,
                'label' => 'Acceptez-vous des animaux',
            ])
            ->add('equipements', EntityType::class, [
                'class' => Equipement::class,
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false,
                'label' => 'Les équipements du gite',
                'expanded' => true
            ])
            ->add('services', EntityType::class, [
                'class' => Service::class,
                "choice_label" => "name",
                "multiple" => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setDefaults([
            'data_class' => Gite::class,
        ]);
    }
}
