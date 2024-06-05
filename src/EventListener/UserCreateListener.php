<?php
namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Symfony\Component\Filesystem\Filesystem;

class UserCreateListener {


public function prePersistUser(User $user, PrePersistEventArgs $event ){
    $this->fs->appendToFile('log.txt','Une nouvelle inscription !');
}
}
