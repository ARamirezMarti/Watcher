<?php

namespace App\Shared\Domain\Bus\Event;

use App\Shared\Infrastructure\Event\SymfonyDomainEvent;

class DomainEvent extends SymfonyDomainEvent
{
    private string $Uuid;
    private  string $name;
    public function __construct($name,$uuid)
    {
        $this->Uuid = $uuid;
        $this->name = $name;
    }

    public static function create(string $name,  $Module ): self{

        
        return new self($name,$Module);
    }

	
	public function getUuid(): string {
		return $this->Uuid;
	}
}
