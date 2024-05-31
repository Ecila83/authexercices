<?php

namespace App\EventListener;

use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

class LoginListener {
    public function loginFlash(LoginSuccessEvent $event) {
        $request = $event->getRequest();
        $userName = $event->getPassport()->getUser()->getName(); // Assuming getUser() returns a User object
        $request->getSession()->getFlashBag()->add('success', 'Bon retour parmi nous  ' . $userName);
    }
}

