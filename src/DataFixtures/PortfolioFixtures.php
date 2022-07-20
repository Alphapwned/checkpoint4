<?php

namespace App\DataFixtures;

use App\Entity\Portfolio;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PortfolioFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $projects = new Portfolio();
            $projects->setName($faker->text(60));
            $projects->setImage($faker->imageUrl());
            $projects->setSummary($faker->text(360));
            $projects->setContent($faker->paragraph(500));
            $projects->setDuration($faker->randomDigitNotNull());
            $projects->setLangage($faker->text(10));
            $manager->persist($projects);
        }

        $manager->flush();
    }
}