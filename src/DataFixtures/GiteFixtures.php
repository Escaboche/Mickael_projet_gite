<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Gite;
use App\Entity\Service;
use App\Entity\Equipement;
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

        $services = [];

        $serv1 = new Service();
        $serv1->setName('Femme de ménage');

        $serv2 = new Service();
        $serv2->setName('Room service');

        $serv3 = new Service();
        $serv3->setName('All-include');

        $serv4 = new Service();
        $serv4->setName('Animal sitter');

        array_push($services,$serv1, $serv2, $serv3, $serv4);

        $manager->persist($serv1);
        $manager->persist($serv2);
        $manager->persist($serv3);
        $manager->persist($serv4);
        $manager->flush();

        for ($i=0; $i <= 100 ; $i++) { 
            $gite = new Gite();
            $gite
                ->setname('Le gite de '. $faker->userName())
                ->setDescription($faker->text(100))
                ->setSurface($faker->numberBetween(61,399))
                ->setBedrooms($faker->numberBetween(2,10))
                ->addEquipement($faker->randomElement($equipements))
                ->addService($faker->randomElement($services))
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
