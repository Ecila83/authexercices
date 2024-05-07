<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(Security $security): Response
    {
        // $user = $this->getUser();
        $user = $security->getUser();

        dump($user);
        // $this->denyAccessUnlessGranted('ROLE_USER');

        // if ($this->isGranted('Role_user')){
        //     dump('auth ok');
        // }else{
        //     dump('auth ko');
        // }

        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]);
    }
}
