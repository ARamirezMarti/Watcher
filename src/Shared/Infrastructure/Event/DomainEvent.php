<?php

namespace App\Shared\Infrastructure\Event;


use App\Library\Domain\Model\Library;
use Symfony\Contracts\EventDispatcher\Event;

class DomainEvent extends Event 
{

    private string $Uuid;
    private $name;
    public function __construct($name,$uuid)
    {
        $this->Uuid = $uuid;
        $this->name = $name;
    }

    public static function create(string $name,Library $Library ): self{

        return new self($name,$Library);
    }

}
