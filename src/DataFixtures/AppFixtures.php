<?php

namespace App\DataFixtures;

use App\Entity\Department;
use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    $faker = Faker\Factory::create('fr_FR');

    // DEPARTMENTS
    $departments = array();
    for ($i = 0; $i < 3; $i++) {
      $departments[$i] = new Department();
      $departments[$i]->setName($faker->word);
      $departments[$i]->setCapacity($faker->randomDigitNotNull);

      $manager->persist($departments[$i]);
    }

    // STUDENTS
    $students = array();
    for ($i = 0; $i < 10; $i++) {
      $students[$i] = new Student();
      $students[$i]->setFirstName($faker->firstName);
      $students[$i]->setLastName($faker->lastName);

      for ($k = 0; $k < mt_rand(5, 15); $k++) {
        $students[$i]->setIdDepartment($departments[mt_rand(0, count($departments) - 1)]);
      }

      $manager->persist($students[$i]);
    }

    $manager->flush();
  }

  /*
    COMMANDS 🚀🚀🚀 :

      php bin/console d:d:c
      php bin/console make:migration
      php bin/console d:m:m
      php bin/console d:f:l

      symfony server:start
  */
}
