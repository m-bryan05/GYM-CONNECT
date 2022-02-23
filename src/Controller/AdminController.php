<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditpeofilType;
use App\Form\EditUserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/", name="")
 */
class AdminController extends AbstractController
{
//********************************************* crud *****************************
// list usersList back
// profil usersprofil front
// delete deleteuser back
// edit editUser => back
// editprofil => font

    /**
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function usersList(UserRepository $users)
    {
        return $this->render('admin/users.html.twig', [
            'users' => $users->findAll(),
        ]);
    }
    /**
     * @Route("/profil", name="profil")
     */
    public function usersprofil(UserRepository $users)
    {
        return $this->render('user/index.html.twig', [
            'users' => $users->findAll(),
        ]);
    }



    /**
     * @Route("/utilisateurs/delete-user/{id}", name="user_delete")
     */
    public function deleteuser(string $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute("utilisateurs");
    }
    /**
     * @Route("/utilisateurs/modifier/{id}", name="modifier_utilisateur")
     */
    public function editUser(User $user, Request $request)
    {
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Utilisateur modifié avec succès');
            return $this->redirectToRoute('utilisateurs');
        }

        return $this->render('admin/edituser.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }
    /**
     * @Route("/user/modifier/{id}", name="modifier_user")
     */
    public function editprofil(User $user, Request $request)
    {
        $form = $this->createForm(EditpeofilType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Utilisateur modifié avec succès');
            return $this->redirectToRoute('profil');
        }

        return $this->render('admin/editprofil.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }
}
