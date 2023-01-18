<?php

namespace Library\Application;

use App\Library\Application\CreateLibrary\createLibraryService;
use App\Library\Application\UpdateLibrary\DTO\updateLibraryInputDTO;
use App\Library\Application\UpdateLibrary\updateLibraryService;
use App\Library\Domain\Repository\LibraryRepository;
use App\Shared\Domain\Bus\Event\IEventBus;
use PHPUnit\Framework\TestCase;
use Test\Library\Domain\LibraryMother;

class updateLibraryTest extends TestCase
{
    private $repository_mock;
    private $eventDispatcher_mock;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository_mock = $this->createMock(LibraryRepository::class);
        $this->eventDispatcher_mock = $this->createMock(IEventBus::class);
    }

    public function testItShouldUpdateALibrary()
    {
        $createLibraryService = new createLibraryService($this->repository_mock, $this->eventDispatcher_mock);

        $this->repository_mock
            ->expects($this->exactly(2))
            ->method('save');

        $Library = $createLibraryService->__invoke(LibraryMother::Create());

        $updateLibraryDTO = new updateLibraryInputDTO($Library->getId(), 'Fake name Updated', 'Fake description Updated');

        $this->repository_mock
        ->expects($this->once())
        ->method('findByUuid')
        ->with($updateLibraryDTO->id)
        ->willReturn($Library);

        $updateLibraryService = new updateLibraryService($this->repository_mock);
        $updateLibraryService->__invoke($updateLibraryDTO);
    }
}
