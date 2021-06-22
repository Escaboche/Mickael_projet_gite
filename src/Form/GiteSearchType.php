<?php

namespace App\Form;

use App\Entity\GiteSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class GiteSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minSurface',IntegerType::class, [
                "required" => false,
                "attr" => [
                "placeholder" => "Surface minimum"]
            ] )
            ->add('maxBedrooms',IntegerType::class, [
                "required" => false,
                "attr" => [
                    "placeholder" => "Nombre de chambre maximum"]
            ])
            ->add('maxPrice',IntegerType::class,[
                "required" => false,
                "attr" => [
                    "placeholder" => "Prix maximum"]
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Soumettre'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GiteSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
