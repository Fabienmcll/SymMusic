<?php

namespace App\DataFixtures;

use App\Entity\Music;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $music = new Music();
        $music->setTitle('Music #1')
            ->setArtist("Astist #1")
            ->setAlbum("Album #1")
            ->setGenre("Genre #1")
            ->setDuration("2");


            
            $manager->persist($music);

        $manager->flush();
    }
}
