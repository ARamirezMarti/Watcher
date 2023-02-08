<?php

namespace App\User\Domain\Entity;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    public ?string $id ;

    public function __construct(
        public ?string $email = null,
        public ?string $password = null
    ){

        $this->id = Uuid::uuid4()->toString();
        $this->email = $email;
        $this->password = $password;
    }

    public static function createUser($Email,$Password): self{
        return new self($Email,$Password);
    }



    public function setPassword(string $Password): void{
        $this->password = $Password;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
	public function getEmail(): ?int {
		return $this->email;
	}


	public function getPassword(): ?string {
		return $this->password;
	}
	
	public function getRoles(): array {
	}
	
	public function getSalt(){
	}
	
	
	public function eraseCredentials() {
	}
	
	
	public function getUsername(): string {
	}

	public function getUserIdentifier():string{}
}
