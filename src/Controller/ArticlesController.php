<?php

namespace App\Controller;

use App\Entity\Articles;
//
use App\Entity\Comments;
use App\Form\ArticlesType;
//
use App\Form\CommentsType;
use App\Repository\ArticlesRepository;
//
use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//
use Symfony\Component\String\Slugger\SluggerInterface;
//
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
//
use DateTime;
use DateTimeZone;

#[Route('/articles')]
class ArticlesController extends AbstractController
{
    public function __construct(private CommentsRepository $commentsRepository){  
    }

    #[Route('/', name: 'app_articles_index', methods: ['GET'])]
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles/index.html.twig', [
            'articles' => $articlesRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     */
    #[Route('/new', name: 'app_articles_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ArticlesRepository $articlesRepository, SluggerInterface $slugger): Response
    {
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();

            // this condition is needed because the 'image' field is not required
            // so the image file must be processed only when a file is uploaded
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('articles_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'imageFilename' property to store the image file name
                // instead of its contents
                $article->setPicture($newFilename);
            }

            $article->setUser($this->getUser());
            $article->setPublishedDate(new DateTime("now"));
            //dump([$form->isSubmitted(), $form->isValid()]);
            $articlesRepository->add($article);
            return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('articles/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_articles_show', methods: ['GET', 'POST'])]
    public function show(Request $request, Articles $article): Response
    {
        $comment = new Comments();
        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment
                ->setArticle($article)
                ->setUser($this->getUser())
                ->setPublishedDate(new DateTime("now"));
            $this->commentsRepository->add($comment);
            // return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('articles/show.html.twig', [
            'comments' => $comment,
            'form' => $form->createView(),
            'article' => $article,
        ]);
    }

    /**
    * @IsGranted("ROLE_ADMIN")
    */
    #[Route('/{id}/edit', name: 'app_articles_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Articles $article, ArticlesRepository $articlesRepository): Response
    {
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articlesRepository->add($article);
            return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('articles/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     */
    #[Route('/{id}/delete', name: 'app_articles_delete', methods: ['POST'])]
    public function delete(Request $request, Articles $article, ArticlesRepository $articlesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            
            $articlesRepository->remove($article);
        }

        return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
    }
}
