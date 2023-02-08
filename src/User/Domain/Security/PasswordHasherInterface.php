<?php

namespace App\User\Domain\Security;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

interface PasswordHasherInterface
{
    public function hashPasswordForUser(PasswordAuthenticatedUserInterface $user, string $password): string;

    public function checkUserPassword(PasswordAuthenticatedUserInterface $user, string $plainPassword): bool;
}

