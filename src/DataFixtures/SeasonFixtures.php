<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;


class SeasonFixtures extends Fixture implements DependentFixtureInterface

{
    public function load(ObjectManager $manager)

    {

        $faker  =  Faker\Factory::create('fr_FR');
        for ($i=0; $i<10; $i++) {
            $season = new Season();
            $season->setYear($faker->year);
            $season->setNumber($faker->unique()->randomDigit);

            $season->setDescription($faker->name);
            $season->setProgram($this->getReference('program_'.rand(0,5)));
            $manager->persist($season);

            $this->addReference('season_'.$i, $season);
        }

        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [ProgramFixtures::class];
    }
}
