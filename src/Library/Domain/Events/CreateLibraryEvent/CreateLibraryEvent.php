<?php

namespace App\Library\Domain\Events\CreateLibraryEvent;

use App\Shared\Domain\Bus\Event\DomainEvent;

class CreateLibraryEvent extends DomainEvent
{
    public string $name ;
    private string $Uuid;

    public function __construct($name,$uuid)
    {
        $this->Uuid = $uuid;
        $this->name = $name;
    }

    public static function create(string $name,  $Library): self
    {
        return new self($name,$Library->getId());
    }

    

	/**
	 * @return string
	 */
	public function getUuid(): string {
		return $this->Uuid;
	}
}
