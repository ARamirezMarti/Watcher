<?php

namespace App\User\Application;

use App\User\Domain\Repository\UserRepository;
use App\User\Domain\Security\PasswordHasherInterface;
use App\User\Domain\Entity\User;
use PHPUnit\Framework\TestCase;
use App\User\Domain\Exception\UserNotFound;

class deleteUserTest extends TestCase
{
    private UserRepository $userRepository_mock;
    private PasswordHasherInterface $hasher_mock;
    public function setUp(): void 
    {
        parent::setUp();
        $this->userRepository_mock = $this->createMock(UserRepository::class);
        $this->hasher_mock = $this->createMock(PasswordHasherInterface::class); 

    }

    public function testItShouldDeleteUser()
    {
        $Email = "test@api.com";

        $User = User::createUser($Email,'PasswordTest');
        
        $UserDeleterService = new UserDeleter($this->userRepository_mock);
        

        $this->userRepository_mock
            ->expects($this->once())
            ->method('findByEmailOrFail')
            ->with($Email)
            ->willReturn($User);
        
        $this->userRepository_mock
            ->expects($this->once())
            ->method('remove')
            ->with($User);

        $UserDeleterService->__invoke($Email);
    }

    public function testItShouldReturnExceptionOnUserNotFound()
    {

        $this->expectException(UserNotFound::class);

        $Email = "test@api.com";

        
        $UserDeleterService = new UserDeleter($this->userRepository_mock);
        

        $this->userRepository_mock
            ->expects($this->once())
            ->method('findByEmailOrFail')
            ->with($Email)
            ->willThrowException(new UserNotFound("User not found"));
        
        

        $UserDeleterService->__invoke($Email);
    }
}
