<?php

namespace App\DataFixtures;

use App\Entity\Music;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->loadMusic($manager);
        $this->loadUsers($manager); 

        $manager->flush();
    }

    private function loadMusic(ObjectManager $manager): void
    {
        $this->createMusic($manager, 'Jeune', 'Louane', 'Louane', 'Pop', 2015);
        $this->createMusic($manager, 'À nos souvenirs', 'Trois Cafés Gourmands', 'Un air de rien', 'Chanson française', 2018);
        $this->createMusic($manager, 'Dernière danse', 'Indila', 'Mini World', 'Pop, R&B', 2014);
        $this->createMusic($manager, 'Tous les mêmes', 'Stromae', 'Racine Carrée', 'Electropop, Hip-hop', 2013);
        $this->createMusic($manager, 'Libérée, Délivrée', 'Anaïs Delva ', 'La Reine des Neiges', 'Musique de film, Pop', 2013);
        $this->createMusic($manager, 'Papaoutai', 'Stromae', 'Racine Carrée', 'Electropop, World', 2013);
        $this->createMusic($manager, 'On ira', 'Zaz', 'Recto Verso', 'Chanson française, Jazz', 2013);
        $this->createMusic($manager, 'Comme d\'habitude', 'Claude François', 'Comme d\'habitude', 'Chanson française, Pop', 1968);
        $this->createMusic($manager, 'La Bohème', 'Charles Aznavour', 'La Bohème', 'Chanson française', 1965);
        $this->createMusic($manager, 'Jour 1', 'Louane', 'Chambre 12', 'Pop, Chanson française', 2015);
        $this->createMusic($manager, 'Résiste', 'France Gall', 'Résiste', 'Chanson française, Pop', 1981);
        $this->createMusic($manager, 'Shape of You', 'Ed Sheeran', '', 'Pop, R&B', 2017);
        $this->createMusic($manager, 'Ne me quitte pas', 'Jacques Brel', 'La chanson des vieux amants', 'Chanson française', 1959);
        $this->createMusic($manager, 'Waka Waka (This Time for Africa)', 'Shakira', 'Sale el Sol', 'Pop, World', 2010);
        $this->createMusic($manager, 'Bohemian Rhapsody', 'Queen', 'A Night at the Opera', 'Rock', 1975);
        $this->createMusic($manager, 'Someone Like You', 'Adele', '21', 'Pop, Soul', 2011);
        $this->createMusic($manager, 'La Mer', 'Charles Trenet', 'La Mer', 'Chanson française', 1946);
        $this->createMusic($manager, 'Halo', 'Beyoncé', 'I Am... Sasha Fierce', 'Pop, R&B', 2008);
        $this->createMusic($manager, 'Avenir', 'Louane', 'Chambre 12', 'Pop, Chanson française', 2015);
        $this->createMusic($manager, 'Lose Yourself', 'Eminem', '8 Mile Soundtrack', 'Hip-hop', 2002);

        $manager->flush();
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
            ->setDuration(rand(1, 5))
            ->setSongUrl('https://youtube.com');

        $manager->persist($music);
    }

    private function loadUsers(ObjectManager $manager): void
    {
        $this->createUser($manager, 'Dupont');
        $this->createUser($manager, 'Martin');
        $this->createUser($manager, 'Lefevre');
        $this->createUser($manager, 'Doe');
        $this->createUser($manager, 'Smith');
        $this->createUser($manager, 'Johnson');
        $this->createUser($manager, 'Taylor');
        $this->createUser($manager, 'Brown');
        $this->createUser($manager, 'Anderson');
        $this->createUser($manager, 'Thomas');

    }

    private function createUser(
        ObjectManager $manager,
        string $name,
    ): void {
        $user = new Users();
        $user->setName($name);
    
        $manager->persist($user);
    }
}
