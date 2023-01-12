<?php

namespace App\Library\Application\getLibrary\DTO;

use App\Library\Domain\Model\Library;

class getLibraryOutputDTO
{
    public function __construct(public readonly ?string $id, public readonly ?string $name, public readonly ?string $description)
    {
    }

    public static function create(Library $library): self
    {
        return new self($library->getId(), $library->getName(), $library->getDescription());
    }
}
