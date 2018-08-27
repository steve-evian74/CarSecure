<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\User1Type;
use App\Form\GarageType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/gestion")
 */
class UserController extends Controller {

    /**
     * @Route("/voiture", name="vos_voitures", methods="GET")
     */
    public function index(UserRepository $userRepository, UserInterface $UserInterface): Response {
        $userID = $UserInterface->getid();
        $id = $UserInterface->getId();
        return $this->render('user/voiture.html.twig', ['users' => $userRepository->findBy(array('id' => $id))]);
        }

        /**
         * @Route("/new", name="user_new", methods="GET|POST")
         */
        public function new(Request $request): Response
        {
        $user = new User();
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
                    'user' => $user,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/test", name="user_show", methods="GET")
     */
    public function show(User $user): Response {
        return $this->render('user/show.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/edit/{id}", name="user_edit", methods="GET|POST")
     */
    public function edit(Request $request, User $user, UserInterface $userInterface): Response {
        $userGarage = $userInterface->getRoles();
        $form = $this->createForm(User1Type::class, $user);
        $formGarage = $this->createForm(GarageType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() || $formGarage->isSubmitted() && $formGarage->isValid() ){
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', ['id' => $user->getId()]);
        }
        if ($userGarage[0] == 'ROLE_PARTICULIER') {


            return $this->render('user/gestion.compte.particulier.html.twig', [
                        'user' => $user,
                        'form' => $form->createView(),
            ]);
        }
        if ($userGarage[0] == 'ROLE_GARAGISTE') {


            return $this->render('garage/gestion.compte.garage.html.twig', [
                        'user' => $user,
                        'form' => $formGarage->createView(),
            ]);
        }
    }

    /**
     * @Route("/{id}", name="user_delete", methods="DELETE")
     */
    public function delete(Request $request, User $user): Response {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('index');
    }

    /**
     * @Route("/{id}", name="gestion_compte",requirements={"id" = "\d+"}, methods="GET|POST")
     * 
     */
    public function gestionCompte(Request $request, UserInterface $userInterface, User $user, $id): Response {
        $userId = $userInterface->getid();
        $userGarage = $userInterface->getRoles();
        //echo $userGarage[0];

        $request->query->get($userId);
        $formGarage = $this->createForm(GarageType::class, $user);
        $formGarage->handleRequest($request);
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() || $formGarage->isSubmitted() && $formGarage->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gestion_compte', ['id' => $user->getId()]);
        }
        if ($request->get('id') == $userId) {
            if ($userGarage[0] == 'ROLE_PARTICULIER') {
                return $this->render('User/gestion.compte.particulier.html.twig', [
                            'user' => $user,
                            'form' => $form->createView(),]);
            } elseif ($userGarage[0] == 'ROLE_GARAGISTE') {
                return $this->render('Garage/gestion.compte.garage.html.twig', [
                            'user' => $user,
                            'form' => $formGarage->createView(),]);
            }
        } else {
            return $this->redirect($this->generateUrl('gestion_compte', array('id' => $userId)));
        }
    }

}
