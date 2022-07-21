<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $contacts = new Contact();
            $contacts->setFirstname($faker->firstName());
            $contacts->setLastname($faker->lastName());
            $contacts->setEmail($faker->email());
            $contacts->setMessage($faker->sentence());
            $contacts->setCreatedAt();
            $contacts->setIsHidden($faker->numberBetween(0, 1));
            $manager->persist($contacts);
        }

        $manager->flush();
    }
}