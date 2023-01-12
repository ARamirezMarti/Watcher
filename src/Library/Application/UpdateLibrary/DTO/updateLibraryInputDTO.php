<?php

namespace App\Library\Application\UpdateLibrary\DTO;

class updateLibraryInputDTO
{
    public function __construct(public readonly string $id, public readonly ?string $name = '', public readonly ?string $description = '')
    {
    }

    public static function create($data): self
    {
        $id = $data['id'] ;
        $name = $data['name'] ? $data['name'] : null;
        $description = $data['description'] ? $data['description'] : null;

        return new static($id,$name,$description);
    }
}
