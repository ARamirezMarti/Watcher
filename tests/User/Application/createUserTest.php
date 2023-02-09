<?php

namespace App\User\Application;

use App\User\Domain\Repository\UserRepository;
use App\User\Domain\Security\PasswordHasherInterface;
use App\User\Application\UserCreator;
use App\User\Domain\Entity\User;
use PHPUnit\Framework\TestCase;


class createUserTest extends TestCase
{
    private UserRepository $userRepository_mock;
    private PasswordHasherInterface $hasher_mock;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository_mock = $this->createMock(UserRepository::class);
        $this->hasher_mock = $this->createMock(PasswordHasherInterface::class); 
    }
    
    public function testUserShouldBeCreate()
    {
        $Payload = [
            "Email" => "test@api.com",
            "Password" => "Testpassword1!"
        ];
        
        $UserCreatorService = new UserCreator($this->userRepository_mock,$this->hasher_mock);
        
        $this->hasher_mock->
        expects($this->once())
        ->method('hashPasswordForUser');
        
        
        $this->userRepository_mock
        ->expects($this->once())
        ->method('save')
        ->with(
            $this->callback(function (User $user) use ($Payload):bool{
                return $user->getEmail() === $Payload['Email'];
            })
        );
        $UserCreatorService->__invoke($Payload);
    }
}
