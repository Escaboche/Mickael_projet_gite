<?php

namespace App\Form;


use App\Entity\Equipement;
use App\Entity\GiteSearch;
use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class GiteSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) : void
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
            ->add('byEquipement',EntityType::class,[
                'label' => 'Trie par équipement ',
                "required" => false,
                "class" => Equipement::class,
                "expanded" => true,
                "multiple" => true

            ])->add('animalsFriendly',CheckboxType::class,[
                "label" => "Les animeaux sont acceptés ",
                "required" => false
            ])
            ->add('byServices',EntityType::class,[
                'label' => 'Trie par Service ',
                "required" => false,
                "class" => Service::class,
                "expanded" => true,
                "multiple" => true
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Soumettre'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setDefaults([
            'data_class' => GiteSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix() : string
    {
        return '';
    }
}
