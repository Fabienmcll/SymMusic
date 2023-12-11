<?php

namespace App\Controller;

use App\Entity\Music;
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
                'succes',
                'votre musique a été ajouté avec succès !'
            );

            return $this->redirectToRoute('app_music');

            return $this->redirectToRoute('app_music'); 
        }

        return $this->render('pages/music/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}



