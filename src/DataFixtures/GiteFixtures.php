<?php

namespace App\DataFixtures;

use App\Entity\Equipement;
use Faker;
use App\Entity\Gite;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GiteFixtures extends Fixture
{
    

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $equipements = [];

        $eq1 = new Equipement();
        $eq1->setName('Micro-onde');

        $eq2 = new Equipement();
        $eq2->setName('Lave-vaisselle');

        $eq3 = new Equipement();
        $eq3->setName('Machine à laver');

        $eq4 = new Equipement();
        $eq4->setName('Jacuzzi');

        array_push($equipements, $eq1,$eq2,$eq3,$eq4);

        $manager->persist($eq1);
        $manager->persist($eq2);
        $manager->persist($eq3);
        $manager->persist($eq4);
        $manager->flush();

        for ($i=0; $i <= 100 ; $i++) { 
            $gite = new Gite();
            $gite
                ->setname('Le gite de '. $faker->userName())
                ->setDescription($faker->text(100))
                ->setSurface($faker->numberBetween(61,399))
                ->setBedrooms($faker->numberBetween(2,10))
                ->addEquipement($faker->randomElement($equipements))
                ->setAddress($faker->streetAddress())
                ->setCity($faker->city())
                ->setPostalCode($faker->postcode())
                ->setAnimals($faker->boolean())
                ->setCreatedAt($faker->dateTimeThisYear('now','Europe/Paris'));
                
            $manager->persist($gite);
        }

        $manager->flush();
    }
}
