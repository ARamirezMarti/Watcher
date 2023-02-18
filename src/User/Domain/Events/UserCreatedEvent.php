<?php

namespace App\User\Domain\Events;
use App\Shared\Domain\Bus\Event\DomainEvent;

class UserCreatedEvent extends DomainEvent
{
    public string $name ;
    private  $User;

    public function __construct($name,$User)
    {
        $this->User = $User;
        $this->name = $name;
    }

    public static function create(string $name,  $User): self
    {
        return new self($name,$User);
    }

    

	/**
	 * @return string
	 */
	public function getUserUuid(): string {
		return $this->User->getId();
	}

    public function getUserEmail(): string 
    {
        return $this->User->getEmail();
    }
}
