<?php

namespace App\DataFixtures;

use App\Entity\Export;
use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        //create Faker factory
        $faker = Faker\Factory::create();
        //adding Providers for data generation
        $faker->addProvider(new Faker\Provider\en_US\Company($faker));
        $faker->addProvider(new Faker\Provider\en_US\Address($faker));
        $faker->addProvider(new Faker\Provider\DateTime($faker));
        //Looping 1 Location will have 3 Exports, total 3x10 = 30 exports
        for ($i = 0; $i < 10; $i++) {
            $location = new Location();
            //add adress
            $location->setLocation($faker->address);

            $manager->persist($location);

            for ($j=0;$j<3; $j++){
                $export = new Export();
                //setting fields
                $export->setName("Test delivery");
                $export->setData(\DateTime::createFromFormat('Y-m-d',$faker->dateTimeInInterval('-7 days', '+ 5 days',null)->format('Y-m-d')));
                $export->setTime(\DateTime::createFromFormat('H:i:s',$faker->time($format = 'H:i:s', 'now')));
                $export->setDeliveryName($faker->name);
                $export->setLocation($location);
                $manager->persist($export);
            }
        }
        //flushing all generated dummy data into database
        $manager->flush();
    }
}
