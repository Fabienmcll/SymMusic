<?php

namespace App\DataFixtures;

use App\Entity\Music;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadMusic($manager);

        // USERS
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setFullName($this->faker->name())
                ->setPseudo(mt_rand(0, 1) === 1 ? $this->faker->firstName() : null)
                ->setEmail($this->faker->email())
                ->setPassword('password');

            $manager->persist($user);
        }

        $manager->flush();
    }

    private function loadMusic(ObjectManager $manager): void
    {
        // Créer des chansons spécifiques avec des artistes, des albums, des genres, etc.
        $this->createMusic($manager, 'Jeune', 'Louane', 'Louane', 'Pop', 2015);
        $this->createMusic($manager, 'À nos souvenirs', 'Trois Cafés Gourmands', 'Un air de rien', 'Chanson française', 2018);
        $this->createMusic($manager, 'Dernière danse', 'Indila', 'Mini World', 'Pop, R&B', 2014);
        $this->createMusic($manager, 'Tous les mêmes', 'Stromae', 'Racine Carrée', 'Electropop, Hip-hop', 2013);
        $this->createMusic($manager, 'Libérée, Délivrée', 'Anaïs Delva (La Reine des Neiges)', 'La Reine des Neiges (Bande Originale)', 'Musique de film, Pop', 2013);
        $this->createMusic($manager, 'Papaoutai', 'Stromae', 'Racine Carrée', 'Electropop, World', 2013);
        $this->createMusic($manager, 'On ira', 'Zaz', 'Recto Verso', 'Chanson française, Jazz', 2013);
        $this->createMusic($manager, 'Comme d\'habitude', 'Claude François', 'Comme d\'habitude', 'Chanson française, Pop', 1968);
        $this->createMusic($manager, 'La Bohème', 'Charles Aznavour', 'La Bohème', 'Chanson française', 1965);
        $this->createMusic($manager, 'Jour 1', 'Louane', 'Chambre 12', 'Pop, Chanson française', 2015);
    }

    private function createMusic(
        ObjectManager $manager,
        string $title,
        string $artist,
        string $album,
        string $genre,
        int $releaseYear
    ): void {
        $music = new Music();
        $music->setTitle($title)
            ->setArtist($artist)
            ->setAlbum($album)
            ->setReleaseYear($releaseYear)
            ->setGenre($genre)
            ->setDuration(max(1, mt_rand(0, 5)))
            ->setSongUrl('https://example.com'); // Remplacez par les véritables URL de chansons si vous les avez.

        $manager->persist($music);
    }
}
