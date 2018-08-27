<?php

namespace App\Controller;

use App\Entity\CategorieIntervention;
use App\Form\CategorieInterventionType;
use App\Repository\CategorieInterventionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categorie/intervention")
 */
class CategorieInterventionController extends Controller
{
    /**
     * @Route("/", name="categorie_intervention_index", methods="GET")
     */
    public function index(CategorieInterventionRepository $categorieInterventionRepository): Response
    {
        return $this->render('categorie_intervention/index.html.twig', ['categorie_interventions' => $categorieInterventionRepository->findAll()]);
    }

    /**
     * @Route("/new", name="categorie_intervention_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $categorieIntervention = new CategorieIntervention();
        $form = $this->createForm(CategorieInterventionType::class, $categorieIntervention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieIntervention);
            $em->flush();

            return $this->redirectToRoute('categorie_intervention_index');
        }

        return $this->render('categorie_intervention/new.html.twig', [
            'categorie_intervention' => $categorieIntervention,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_intervention_show", methods="GET")
     */
    public function show(CategorieIntervention $categorieIntervention): Response
    {
        return $this->render('categorie_intervention/show.html.twig', ['categorie_intervention' => $categorieIntervention]);
    }

    /**
     * @Route("/{id}/edit", name="categorie_intervention_edit", methods="GET|POST")
     */
    public function edit(Request $request, CategorieIntervention $categorieIntervention): Response
    {
        $form = $this->createForm(CategorieInterventionType::class, $categorieIntervention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_intervention_edit', ['id' => $categorieIntervention->getId()]);
        }

        return $this->render('categorie_intervention/edit.html.twig', [
            'categorie_intervention' => $categorieIntervention,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_intervention_delete", methods="DELETE")
     */
    public function delete(Request $request, CategorieIntervention $categorieIntervention): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieIntervention->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorieIntervention);
            $em->flush();
        }

        return $this->redirectToRoute('categorie_intervention_index');
    }
}
