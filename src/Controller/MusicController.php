<?php
namespace App\Controller;

use App\Repository\MusicRepository;
use Knp\Component\Pager\PaginatorInterface; // Correction du namespace
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MusicController extends AbstractController
{
    // Affiché tout les musiques
    #[Route('/music', name: 'app_music', methods: ['GET'] )]
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
}

