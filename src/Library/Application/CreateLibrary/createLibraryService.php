<?php

namespace App\Library\Application\CreateLibrary;

use App\Library\Domain\Events\CreateLibraryEvent\CreateLibraryEvent;
use App\Library\Domain\Model\Library;
use App\Library\Domain\Model\LibraryDescription;
use App\Library\Domain\Model\LibraryName;
use App\Library\Domain\Repository\LibraryRepository;
use App\Shared\Domain\Bus\Event\IEventBus;

class createLibraryService
{
    private $LibraryRepository;
    private $EventDispatcher;

    public function __construct(
        LibraryRepository $libraryRepository, IEventBus $eventDispatcher)
    {
        $this->LibraryRepository = $libraryRepository;
        $this->EventDispatcher = $eventDispatcher;
    }

    public function __invoke($LibraryDTO)
    {
        $library = Library::create(new LibraryName($LibraryDTO->name), new LibraryDescription($LibraryDTO->description));

        $this->LibraryRepository->save($library);

        $this->EventDispatcher->publishEvent(CreateLibraryEvent::create("library.created",$library));

        return $library;
    }
}
