<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;


class EpisodeFixtures extends Fixture implements DependentFixtureInterface

{
    public function load(ObjectManager $manager)

    {

        $faker  =  Faker\Factory::create('fr_FR');
        for ($i=0; $i<10; $i++) {
            $season = new Episode();
            $season->setNumber($faker->unique()->randomDigit);
            $season->setSummary($faker->text);
            $season->setTitle($faker->title);
            $season->setSeason($this->getReference('season_'.rand(0,2)));
            $manager->persist($season);
            $this->addReference('episode_'.$i, $season);
        }

        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [SeasonFixtures::class];
    }
}
