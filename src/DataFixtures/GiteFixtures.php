<?php

namespace App\DataFixtures;


use Faker;
use App\Entity\Gite;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GiteFixtures extends Fixture
{
    

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i <= 100 ; $i++) { 
            $gite = new Gite();
            $gite
                ->setname('Le gite de '. $faker->userName())
                ->setDescription($faker->text(100))
                ->setSurface($faker->numberBetween(61,399))
                ->setBedrooms($faker->numberBetween(2,10))
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
