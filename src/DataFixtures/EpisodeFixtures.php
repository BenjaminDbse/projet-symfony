<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;


class EpisodeFixtures extends Fixture implements DependentFixtureInterface

{
    private Slugify $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }
    public function load(ObjectManager $manager)

    {

        $faker  =  Faker\Factory::create('fr_FR');
        for ($i=0; $i<10; $i++) {
            $episode = new Episode();
            $episode->setNumber($faker->unique()->randomDigit);
            $episode->setSummary($faker->text);
            $episode->setTitle($faker->sentence(4));
            $episode->setSeason($this->getReference('season_'.rand(0,2)));

            $slug = $this->slugify->generate($episode->getTitle());
            $episode->setSlug($slug);

            $manager->persist($episode);
            $this->addReference('episode_'.$i, $episode);
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
