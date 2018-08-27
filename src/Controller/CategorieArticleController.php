<?php

namespace App\Controller;

use App\Entity\CategorieArticle;
use App\Form\CategorieArticleType;
use App\Repository\CategorieArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categorie/article")
 */
class CategorieArticleController extends Controller
{
    /**
     * @Route("/", name="categorie_article_index", methods="GET")
     */
    public function index(CategorieArticleRepository $categorieArticleRepository): Response
    {
        return $this->render('categorie_article/index.html.twig', ['categorie_articles' => $categorieArticleRepository->findAll()]);
    }

    /**
     * @Route("/new", name="categorie_article_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $categorieArticle = new CategorieArticle();
        $form = $this->createForm(CategorieArticleType::class, $categorieArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieArticle);
            $em->flush();

            return $this->redirectToRoute('categorie_article_index');
        }

        return $this->render('categorie_article/new.html.twig', [
            'categorie_article' => $categorieArticle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_article_show", methods="GET")
     */
    public function show(CategorieArticle $categorieArticle): Response
    {
        return $this->render('categorie_article/show.html.twig', ['categorie_article' => $categorieArticle]);
    }

    /**
     * @Route("/{id}/edit", name="categorie_article_edit", methods="GET|POST")
     */
    public function edit(Request $request, CategorieArticle $categorieArticle): Response
    {
        $form = $this->createForm(CategorieArticleType::class, $categorieArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_article_edit', ['id' => $categorieArticle->getId()]);
        }

        return $this->render('categorie_article/edit.html.twig', [
            'categorie_article' => $categorieArticle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_article_delete", methods="DELETE")
     */
    public function delete(Request $request, CategorieArticle $categorieArticle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieArticle->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorieArticle);
            $em->flush();
        }

        return $this->redirectToRoute('categorie_article_index');
    }
}
