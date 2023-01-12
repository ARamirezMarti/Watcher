<?php

namespace App\Library\Application\CreateLibrary\DTO;

class createLibraryInputDTO
{
    public function __construct(public readonly string|null $name, public readonly string|null $description)
    {
    }

    public static function create($data): self
    {
        $name = $data['name'] ?? null;
        $description = $data['description'] ?? null;

        return new static($name,$description);
    }
}
