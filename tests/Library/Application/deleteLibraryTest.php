<?php

namespace Library\Application;

use App\Library\Application\CreateLibrary\createLibraryService;
use App\Library\Application\DeleteLibrary\deleteLibraryService;
use App\Library\Domain\EventDispatcher\DomainEventDispatcher;
use App\Library\Domain\Repository\LibraryRepository;
use App\Shared\Domain\Bus\Event\IEventBus;
use PHPUnit\Framework\TestCase;
use Test\Library\Domain\LibraryMother;

class deleteLibraryTest extends TestCase
{
    private $repository_mock;
    private $eventDispatcher_mock;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository_mock = $this->createMock(LibraryRepository::class);
        $this->eventDispatcher_mock = $this->createMock(IEventBus::class);
    }

    public function testItShouldDeleteALibrary()
    {
        $library_data = LibraryMother::Create();
        $createLibraryService = new createLibraryService($this->repository_mock, $this->eventDispatcher_mock);

        $this->repository_mock
            ->expects($this->once())
            ->method('save');

        $Library = $createLibraryService->__invoke($library_data);

        $this->repository_mock
            ->expects($this->once())
            ->method('findByUuid')
            ->with($Library->getId())
            ->willReturn($Library);

        $this->repository_mock
            ->expects($this->once())
            ->method('delete')
            ->with($Library);

        $deleteLibraryService = new deleteLibraryService($this->repository_mock);
        $deleteLibraryService->__invoke($Library->getId());
    }
}
