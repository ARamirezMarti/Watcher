<?php

namespace App\User\Adapter\Security;

use App\User\Domain\Security\PasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class PasswordHasher implements PasswordHasherInterface
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function hashPasswordForUser(PasswordAuthenticatedUserInterface $user,string $plainPassword): string{

    return $this->passwordHasher->hashPassword($user, $plainPassword);
    }
    public function checkUserPassword(PasswordAuthenticatedUserInterface  $user, string $plainPassword): bool{

        return $this->passwordHasher->isPasswordValid($user, $plainPassword);
    }
}
