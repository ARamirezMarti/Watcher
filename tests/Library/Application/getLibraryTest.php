<?php

namespace Library\Application;

use App\Library\Application\CreateLibrary\createLibraryService;
use App\Library\Application\getLibrary\DTO\getLibraryOutputDTO;
use App\Library\Application\getLibrary\getLibraryService;
use App\Library\Domain\Exceptions\InvalidArgumentDomainException;
use App\Library\Domain\Repository\LibraryRepository;
use App\Library\Domain\EventDispatcher\DomainEventDispatcher;
use App\Shared\Domain\Bus\Event\IEventBus;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Test\Library\Domain\LibraryMother;

class getLibraryTest extends TestCase
{
    private $repository_mock;
    private $eventDispatcher_mock;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository_mock = $this->createMock(LibraryRepository::class);
        $this->eventDispatcher_mock = $this->createMock(IEventBus::class);
    }

    public function testItShouldReturnALibrary()
    {
        // Arrange
        $createLibraryService = new createLibraryService($this->repository_mock, $this->eventDispatcher_mock);


        //Act
        $this->repository_mock
            ->expects($this->once())
            ->method('save');

        $newLibrary = $createLibraryService->__invoke(LibraryMother::Create());

        $getLibraryService = new getLibraryService($this->repository_mock);

        $this->repository_mock
            ->expects($this->once())
            ->method('findByUuid')
            ->willReturn($newLibrary);

        $getLibrary = $getLibraryService->__invoke($newLibrary->getId());

        // Assert
        $this->assertInstanceOf(getLibraryOutputDTO::class, $getLibrary);

        $this->assertObjectHasAttribute('id', $getLibrary);
        $this->assertObjectHasAttribute('name', $getLibrary);
        $this->assertObjectHasAttribute('description', $getLibrary);
    }

    public function testItShouldThrownExceptionOnNotExistingId()
    {
        $this->expectException(InvalidArgumentDomainException::class);

        $getLibraryService = new getLibraryService($this->repository_mock);

        $this->repository_mock
            ->expects($this->once())
            ->method('findByUuid')
            ->willThrowException(new InvalidArgumentDomainException());

        $getLibraryService->__invoke(Uuid::uuid4());
    }
}
