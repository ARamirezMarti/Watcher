<?php

namespace App\User\Application;
use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepository;
use App\User\Domain\Security\PasswordHasherInterface;

class UserCreator
{
    public function __construct(public UserRepository $UserRepository,public PasswordHasherInterface $passwordHasher){

    }

    public function __invoke(array $UserData,){
        
        $User = User::createUser($UserData['Email'], $UserData['Password']);
        $HashedPassword = $this->passwordHasher->hashPasswordForUser($User, $UserData['Password']);
        $User->setPassword($HashedPassword);

        $this->UserRepository->save($User);

        
    }
}
