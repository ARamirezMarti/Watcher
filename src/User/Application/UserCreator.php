<?php

namespace App\User\Application;
use App\Shared\Domain\Bus\Event\IEventBus;
use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepository;
use App\User\Domain\Security\PasswordHasherInterface;
use App\User\Domain\Events\UserCreatedEvent;

class UserCreator
{
    private $EventDispatcher;
    public function __construct(
        private UserRepository $UserRepository,
        private PasswordHasherInterface $passwordHasher,
         IEventBus $eventDispatcher
    ){

        $this->EventDispatcher=$eventDispatcher;
    }

    public function __invoke(array $UserData){
        
        $User = User::createUser($UserData['Email'], $UserData['Password']);
        $HashedPassword = $this->passwordHasher->hashPasswordForUser($User, $UserData['Password']);
        $User->setPassword($HashedPassword);

        $this->UserRepository->save($User);

        $this->EventDispatcher->publishEvent(UserCreatedEvent::create('user.created',$User));

        
    }
}
