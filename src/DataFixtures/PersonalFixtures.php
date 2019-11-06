<?php

namespace App\DataFixtures;

use App\Entity\Personal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;

class PersonalFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

    	$faker=Faker::create();

    	for ($i=0; $i < 15; $i++) { 

	        $personal = new Personal();
	        $personal
	        	->setName($faker->unique()->firstName)
	        	->setLastName($faker->unique()->lastName)
	        	->setEmail($faker->unique()->email)
	        	->setIdentification($faker->unique()->numberBetween(1, 999999));

	        $manager->persist($personal);
    	}

        $manager->flush();
    }
}
