<?php
// src/Controller/PlaylistController.php

namespace App\Controller;

use App\Entity\Playlist;
use App\Form\PlaylistType;
use App\Repository\PlaylistRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/playlist')]
class PlaylistController extends AbstractController
{
    #[Route('/', name: 'app_playlist', methods: ['GET'])]
    public function index(PlaylistRepository $playlistRepository, PaginatorInterface $paginator, Request $request): Response
    {
        // Pagination des playlists
        $playlists = $paginator->paginate(
            $playlistRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        // Affichage de la liste des playlists
        return $this->render('pages/playlist/index.html.twig', [
            'playlists' => $playlists,
        ]);
    }

    #[Route('/new', name: 'app_playlist_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UsersRepository $usersRepository): Response
    {
        // Création d'une nouvelle playlist
        $playlist = new Playlist();

        // Récupération de tous les utilisateurs depuis la base de données
        $users = $usersRepository->findAll();

        // Création du formulaire avec envoi des utilisateurs comme option
        $form = $this->createForm(PlaylistType::class, $playlist, ['users' => $users]);

        // Gestion de la soumission du formulaire
        $form->handleRequest($request);

        // Vérification si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Attribution de la date de création
            $playlist->setCreatedAt(new \DateTimeImmutable());

            // Persist et flush pour enregistrer la playlist en base de données
            $entityManager->persist($playlist);
            $entityManager->flush();

            // Redirection vers la liste des playlists
            return $this->redirectToRoute('app_playlist', [], Response::HTTP_SEE_OTHER);
        }

        // Affichage du formulaire de création de playlist
        return $this->renderForm('pages/playlist/new.html.twig', [
            'playlist' => $playlist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_playlist_show', methods: ['GET'])]
    public function show(Playlist $playlist): Response
    {
        // Affichage de la page de détails d'une playlist
        return $this->render('pages/playlist/show.html.twig', [
            'playlist' => $playlist,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_playlist_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Playlist $playlist, EntityManagerInterface $entityManager): Response
    {
        // Création du formulaire d'édition
        $form = $this->createForm(PlaylistType::class, $playlist);

        // Gestion de la soumission du formulaire
        $form->handleRequest($request);

        // Vérification si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Flush pour enregistrer les modifications en base de données
            $entityManager->flush();

            // Redirection vers la liste des playlists
            return $this->redirectToRoute('app_playlist', [], Response::HTTP_SEE_OTHER);
        }

        // Affichage du formulaire d'édition
        return $this->renderForm('pages/playlist/edit.html.twig', [
            'playlist' => $playlist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_playlist_delete', methods: ['POST'])]
    public function delete(Request $request, Playlist $playlist, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $playlist->getId(), $request->request->get('_token'))) {
            // Suppression de la playlist
            $entityManager->remove($playlist);
            $entityManager->flush();
        }

        // Redirection vers la liste des playlists
        return $this->redirectToRoute('app_playlist', [], Response::HTTP_SEE_OTHER);
    }

}