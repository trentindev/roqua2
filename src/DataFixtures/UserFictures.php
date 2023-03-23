<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('user1@gmail.com');
        $user->setRoles([]);
        $user->setPassword('azertyui');
        $user->setFirstname('user');
        $user->setLastname('One');



        $manager->persist($user);
        $manager->flush();
    }
}

