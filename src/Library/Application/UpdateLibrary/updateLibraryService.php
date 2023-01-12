<?php

namespace App\Library\Application\UpdateLibrary;

use App\Library\Domain\Model\LibraryDescription;
use App\Library\Domain\Model\LibraryName;
use App\Library\Domain\Repository\LibraryRepository;
use App\Library\Domain\Model\Library;

class updateLibraryService
{
    private $LibraryRepository;

    public function __construct(LibraryRepository $LibraryRepository)
    {
        $this->LibraryRepository = $LibraryRepository;
    }

    public function __invoke($libraryDTO)
    {
        $Library = $this->LibraryRepository->findByUuid($libraryDTO->id);
        $Library->Update($libraryDTO);       

        $this->LibraryRepository->save($Library);

        return $Library;
    }
}
