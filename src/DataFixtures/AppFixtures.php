<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture {

  private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }


  public function load(ObjectManager $manager): void {
     
     $testPassword = 'azertyui';


    // On crée 5 utilisateurs en s'aidant d'une boucle 
    for ($i = 1; $i < 6; $i++) {
      $rank = mt_rand(10, 100);
      $gender = mt_rand(1, 2) == 2 ? 'men' : 'women';
      $user = new User();
      $user->setEmail("user" . $i . "@gmail.com");
      $user->setRoles([]);
      $pwd = $this->hasher->hashPassword($user, $testPassword);
      dump($pwd);
      $user->setPassword($pwd);
      dump($user->getPassword());
      //$user->setPassword('azertyui');
      $user->setFirstname('user' . $i);
      $user->setLastname('Test');
      $user->setPicture("https://randomuser.me/api/portraits/".$gender."/".$rank.".jpg");
      
      $manager->persist($user);
    }
    $manager->flush();
  }
}
