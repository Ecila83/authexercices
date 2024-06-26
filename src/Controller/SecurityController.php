<?php

namespace App\Controller;

use App\Event\NewUserEvent;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    #[Route('/inscription', name: 'inscription')]
    public function inscription(EntityManagerInterface $em, Request $request, UserPasswordHasherInterface $password, EventDispatcherInterface $eventDispatcher): Response
    {
        $user = new User();
        $user->setName('pierre');
        $userForm = $this->createForm(UserType::class, $user);
        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            // $user->setPassword($password->hashPassword($user, $user->getPassword()));
            // $em->persist($user);
            // $em->flush();
            // $eventDispatcher->dispatch(new NewUserEvent($user->getEmail()));
            // return $this->redirectToRoute('home');
        }

        return $this->render('security/inscription.html.twig', [
            'form' => $userForm->createView(),
        ]);
    }

    #[Route('/connexion', name: 'connexion')]
    public function connexion(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $username = $authenticationUtils->getLastUsername();

        return $this->render('security/connexion.html.twig', [
            'error' => $error,
            'username' => $username,
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {
        // Symfony handles the logout automatically
    }
}


