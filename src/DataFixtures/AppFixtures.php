<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create();
        $users = [];

        for ($i = 0; $i < 20; $i++) {

            $user = new User();
            $user->setPassword(password_hash('password', PASSWORD_DEFAULT));
            $user->setPrenom($faker->firstName());
            $user->setNom($faker->lastName());
            $user->setEmail($faker->email());
            $user->setAdresse($faker->address());
            $user->setVille($faker->city());
            $user->setCodePostal($faker->randomNumber(5, true));
            $user->setPays($faker->country());
            $users[] = $user;
            $manager->persist($user);

        }

        $manager->flush();
    }
}
