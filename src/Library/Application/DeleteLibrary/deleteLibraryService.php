<?php

namespace App\Library\Application\DeleteLibrary;

use App\Library\Domain\Repository\LibraryRepository;

class deleteLibraryService
{
    private $libraryRepository;

    public function __construct(LibraryRepository $libraryRepository)
    {
        $this->libraryRepository = $libraryRepository;
    }

    public function __invoke(string $uuid)
    {
        try {
            $Library = $this->libraryRepository->findByUuid($uuid);
            $this->libraryRepository->delete($Library);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
}
