<?php

namespace App\Library\Application\getLibrary;

use App\Library\Application\getLibrary\DTO\getLibraryOutputDTO;
use App\Library\Domain\Repository\LibraryRepository;

class getLibraryService
{
    public function __construct(public LibraryRepository $libraryRepository)
    {
        $this->libraryRepository = $libraryRepository;
    }

    public function __invoke(string $uuid)
    {
        $Library = $this->libraryRepository->findByUuid($uuid);

        return getLibraryOutputDTO::create($Library);
    }
}
