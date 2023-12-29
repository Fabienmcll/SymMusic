<?php

namespace App\Controller;

use App\Entity\Music;
use App\Entity\Playlist;  // Assurez-vous que Playlist est bien importé
use App\Form\MusicType;
use App\Repository\MusicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MusicController extends AbstractController
{
    #[Route('/music', name: 'app_music', methods: ['GET'])]
    public function index(MusicRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $musics = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/music/index.html.twig', [
            'musics' => $musics
        ]);
    }

    #[Route('/music/nouveau', name: 'music.new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager 
    ): Response {
        $music = new Music();
        $form = $this->createForm(MusicType::class, $music);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($music);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre musique a été ajoutée avec succès !'
            );

            return $this->redirectToRoute('app_music'); 
        }

        return $this->render('pages/music/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/music/edition/{id}', name: 'music.edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $musicId = $request->attributes->get('id'); // Récupérer l'id depuis la requête

        $music = $manager->getRepository(Music::class)->find($musicId);

        if (!$music) {
            throw $this->createNotFoundException('La musique n\'existe pas.');
        }

        $form = $this->createForm(MusicType::class, $music);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre musique a été modifiée avec succès !'
            );

            return $this->redirectToRoute('app_music');
        }

        return $this->render('pages/music/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/music/suppression/{id}', name: 'music.delete', methods: ['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        $id // Récupérer l'ID directement depuis la route
    ): Response {
        $music = $manager->getRepository(Music::class)->find($id);

        if (!$music) {
            $this->addFlash(
                'success',
                'Votre musique n\'a pas été trouvée !'
            );
            return $this->redirectToRoute('music.index');
        }

        $manager->remove($music);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre musique a été supprimée avec succès !'
        );

        return $this->redirectToRoute('app_music');
    }
}
