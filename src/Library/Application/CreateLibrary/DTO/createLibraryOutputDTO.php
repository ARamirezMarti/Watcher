<?php

namespace App\Library\Application\CreateLibrary\DTO;

class createLibraryOutputDTO
{
    public function __construct(public readonly ?string $id, public readonly ?string $name, public readonly ?string $description)
    {
    }

    public static function create($library): self
    {
        return new self($library->getId(), $library->getName(), $library->getDescription());
    }
}
