# SymMusic

SymMusic est une plateforme  développée pour la création, le partage et la découverte de playlists musicales. Utilisant Symfony comme framework backend, Tailwind CSS pour un design épuré, et Docker Compose pour la gestion facilitée de MySQL et PHPMyAdmin, SymMusic offre une expérience harmonieuse et conviviale.

## Prérequis

Assurez-vous que les éléments suivants sont installés sur votre machine avant de commencer :

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- [Composer](https://getcomposer.org/)

## Installation

1. Clonez le dépôt sur votre machine locale.

    ```bash
    git clone https://github.com/votre-utilisateur/symMusic.git
    ```

2. Accédez au répertoire du projet.

    ```bash
    cd symMusic
    ```

3. Installez les dépendances Symfony.

    ```bash
    composer install
    ```

4. Copiez le fichier `.env` et configurez les variables d'environnement pour la base de données.

    ```bash
    cp .env.example .env
    ```

5. Lancez les conteneurs Docker.

    ```bash
    docker-compose up -d
    ```

6. Appliquez les migrations Symfony.

    ```bash
    php bin/console doctrine:migrations:migrate
    ```

7. Visitez votre application dans le navigateur à l'adresse [http://localhost](http://localhost).

## Fonctionnalités

- Création de playlists personnalisées.
- Ajout de chansons à vos playlists.
- Partage de playlists avec la communauté.
- Découverte de nouvelles musiques.
- Interface conviviale basée sur Tailwind CSS.

