<?php

namespace App\Library\Domain\Events\CreateLibraryEvent;

use App\Library\Domain\Model\Library;
use App\Shared\Infrastructure\Event\DomainEvent;

class CreateLibraryEvent extends DomainEvent
{
    public string $name ;
    private string $Uuid;

    public function __construct($name,$uuid)
    {
        parent::__construct($name,$uuid);
        $this->Uuid = $uuid;
        $this->name = $name;
    }

    public static function create(string $name,Library $Library): self
    {
        return new static($name,$Library->getId());
    }

    

	/**
	 * @return string
	 */
	public function getUuid(): string {
		return $this->Uuid;
	}
}
