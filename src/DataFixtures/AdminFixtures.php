<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminFixtures extends Fixture
{
    public UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new Admin();
        $user
            ->setEmail('fondevila.gautier@gmail.com')
            ->setRoles(['ROLE_ADMIN'])
        ;

        $hash = $this->passwordHasher->hashPassword($user, 'azerty');

        $user->setPassword($hash);

        $manager->persist($user);
        $manager->flush();
    }
}
