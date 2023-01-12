<?php

namespace Test\Library\Domain;

use App\Library\Application\CreateLibrary\DTO\createLibraryInputDTO;

class LibraryMother
{
    public static function Create()
    {
        $Payload = [
            'name' => 'Fake name',
            'description' => 'Fake description',
        ];

        return createLibraryInputDTO::create($Payload);
    }
}
