<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//
use App\Repository\ArticlesRepository;


class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articlesRepository->findBy([], ['id' => 'DESC'])
        ]);
    }
}
