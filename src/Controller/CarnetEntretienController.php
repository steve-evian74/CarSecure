<?php

namespace App\Controller;

use App\Entity\CarnetEntretien;
use App\Entity\User;
use App\Entity\Voiture;
use App\Form\CarnetEntretienType;
use App\Form\CarnetEntretienGarageType;
use App\Repository\CarnetEntretienRepository;
use App\Repository\UserRepository;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use \Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/entretien")
 */
class CarnetEntretienController extends Controller {

    /**
     * @Route("/", name="carnet_entretien_index", methods="GET")
     */
    public function index(CarnetEntretienRepository $carnetEntretienRepository): Response {
        return $this->render('carnet_entretien/index.html.twig', ['carnet_entretiens' => $carnetEntretienRepository->findAll()]);
        }

        /**
         * @Route("/garage/intervention", name="carnet_entretien_new", methods="GET|POST")
         */
        public function new(Request $request): Response
        {
        $carnetEntretien = new CarnetEntretien();
        $form = $this->createForm(CarnetEntretienType::class, $carnetEntretien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($carnetEntretien);
        $em->flush();

        return $this->redirectToRoute('carnet_entretien_index');
        }

        return $this->render('carnet_entretien/new.html.twig', [
                    'carnet_entretien' => $carnetEntretien,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carnet_entretien_show", methods="GET")
     */
    public function show(CarnetEntretien $carnetEntretien): Response {
        return $this->render('carnet_entretien/show.html.twig', ['carnet_entretien' => $carnetEntretien]);
    }

    /**
     * @Route("/{id}/edit", name="carnet_entretien_edit", methods="GET|POST")
     */
    public function edit(Request $request, CarnetEntretien $carnetEntretien): Response {
        $form = $this->createForm(CarnetEntretienType::class, $carnetEntretien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carnet_entretien_edit', ['id' => $carnetEntretien->getId()]);
        }

        return $this->render('carnet_entretien/edit.html.twig', [
                    'carnet_entretien' => $carnetEntretien,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carnet_entretien_delete", methods="DELETE")
     */
    public function delete(Request $request, CarnetEntretien $carnetEntretien): Response {
        if ($this->isCsrfTokenValid('delete' . $carnetEntretien->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($carnetEntretien);
            $em->flush();
        }

        return $this->redirectToRoute('carnet_entretien_index');
    }

    /**
     * @Route("/particulier/{id}", name="entretien_particulier", methods="GET")
     */
    public function particulier(Request $request, Voiture $Voiture, CarnetEntretienRepository $CarnetEntretienRepository, VoitureRepository $VoitureRepository, CarnetEntretien $carnetEntretien, UserInterface $UserInterface): Response {


        $userID = $UserInterface->getId();

        $FkvoitureID = $carnetEntretien->getFkVoiture();
        dump($FkvoitureID);
        $resultvoiture = $FkvoitureID->getId();

        $voitureId = $Voiture->getId($resultvoiture);
        $resultatUser = $VoitureRepository->findBy(array('fkUser' => $userID, 'id' => $resultvoiture));
        dump($resultatUser);


        if ($resultatUser == null) {
            return $this->render('Error/entretien_particulier.html.twig');
        } else {
            return $this->render('User/entretien_particulier.html.twig', ['carnet_entretien' => $carnetEntretien]);
        }
    }

    /**
     * @Route("/garage/immatriculation" , name="entretien_garage", methods="POST|GET")
     */
    public function rechercheAction(Request $request, VoitureRepository $VoitureRepository) {
        if ($request->isXmlHttpRequest()) {
            $mot_cle = $request->request->get('mot_cle');
            if (!empty($mot_cle)) {
                $resultat = $VoitureRepository->RecherchePlaqueRepository($mot_cle);
                foreach ($resultat[0] as $data)
                    return $this->render('carnet_entretien/recherche.plaque.html.twig', array('immatriculations' => $VoitureRepository->findBy(array('immatriculation' => $data))));
            }
        }
        return $this->render('carnet_entretien/recherche.plaque.html.twig', array('immatriculations' => $VoitureRepository->findAll())
        );
    }
    //@Security("has_role('ROLE_GARAGISTE')")

    /**
     * 
     * @Route("/garage/intervention/{id}/new", name="new_intervention", methods="GET|POST")
     */
    public function newPlaqueDefault(UserInterface $UserInterface, Request $request, UserRepository $UserRepository, VoitureRepository $VoitureRepository, CarnetEntretienRepository $CarnetEntretienRepository): Response {
        $resultatId = $VoitureRepository->findBy(array('id' => $request->get('id')));
        $userID = $UserInterface->getid();
        $userRole = $UserInterface->getNomEntreprise();
        $user = $UserRepository->findBy(array('nomEntreprise' => $userRole));
        foreach ($resultatId as $id) {
            $id;
        }
        foreach ($user as $userResultat) {
            $userResultat;
        }

        $carnetEntretienNew = new CarnetEntretien();
        $date = new \DateTime('now');
        $carnetEntretienNew->setDateIntervention(new \DateTime('now'));
        $carnetEntretienNew->setFkVoiture($id);
        $carnetEntretienNew->setfkUserGarage($userResultat);
        

        $form = $this->createForm(CarnetEntretienGarageType::class, $carnetEntretienNew);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carnetEntretienNew);
            $em->flush();

            return $this->redirectToRoute('carnet_entretien_index');
        }

        return $this->render('carnet_entretien/new.html.twig', [
                    'carnet_entretien_new_intervention' => $carnetEntretienNew,
                    'form' => $form->createView(), 'id' => $id, 'date' => $date, 'user' => $userResultat,
        ]);
    }

}
