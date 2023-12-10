<?php

namespace App\DataFixtures;

use App\Entity\Music;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Faker\Generator;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create("fr_FR");
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 50; $i++) {
            $music = new Music();
            $music->setTitle($this->faker->word())
                ->setArtist("Artist " . $i)
                ->setAlbum("Album " . $i)
                ->setReleaseYear($this->faker->year())
                ->setGenre("Genre " . $i)
                ->setDuration(max(1, mt_rand(0, 5))) // Durée minimale de 1
                ->setSongUrl($this->faker->url());

            $manager->persist($music);
        }

        $manager->flush();
    }
}
