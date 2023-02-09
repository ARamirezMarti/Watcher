<?php

namespace App\User\Application;
use App\User\Domain\Repository\UserRepository;

class UserDeleter
{

    public function __construct(private UserRepository $userRepository){

    }

    public function __invoke(string $Email){

        $User = $this->userRepository->findByEmailOrFail($Email);
        $this->userRepository->remove($User);
    }
}
