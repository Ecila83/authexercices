<?php

namespace App\EventSubscriber;

use Symfony\Component\Security\Http\Event\LogoutEvent;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;

class WelcomeSubscriber implements EventSubscriberInterface
{
 

    public function __construct(private Filesystem $fs){
  
    }

    public function onLoginSuccessEvent(LoginSuccessEvent $event): void
    {
        $request = $event->getRequest();
        $userName = $event->getPassport()->getUser()->getName(); // Assuming getUser() returns a User object
        $request->getSession()->getFlashBag()->add('success', 'welcome ' . $userName);
    }

    public function onLogout(LogoutEvent $event): void
    {
        $this->fs->appendToFile('log.txt', $event->getToken()->getUser()->getEmail(). 'est maintenant deconnecté'. PHP_EOL);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            LoginSuccessEvent::class => ['onLoginSuccessEvent', 150],
            LogoutEvent::class => 'onLogout',
        ];
    }
}
