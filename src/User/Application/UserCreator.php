<?php

namespace App\User\Application;
use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepository;
use App\User\Adapter\Security\PasswordHasher;

class UserCreator
{
    public function __construct(public UserRepository $UserRepository,public PasswordHasher $passwordHasher){

    }

    public function __invoke(array $UserData,){
        
        $User = User::createUser($UserData['Email'], $UserData['Password']);
        $HashedPassword = $this->passwordHasher->hashPasswordForUser($User, $UserData['Password']);
        $User->setPassword($HashedPassword);

        $this->UserRepository->save($User);

        
    }
}
