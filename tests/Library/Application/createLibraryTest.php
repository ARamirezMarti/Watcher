<?php

namespace Library\Application;

use App\Library\Application\CreateLibrary\createLibraryService;
use App\Library\Application\CreateLibrary\DTO\createLibraryInputDTO;
use App\Library\Domain\Exceptions\InvalidArgumentDomainException;
use App\Library\Domain\Repository\LibraryRepository;
use App\Shared\Domain\Bus\Event\IEventBus;
use PHPUnit\Framework\TestCase;
use Test\Library\Domain\LibraryMother;

class createLibraryTest extends TestCase
{
    private $repository_mock;
    private $eventDispatcher_mock;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository_mock = $this->createMock(LibraryRepository::class);
        $this->eventDispatcher_mock = $this->createMock(IEventBus::class);
    }

    public function testItShouldCreateALibrary()
    {
        $createLibraryService = new createLibraryService($this->repository_mock, $this->eventDispatcher_mock);

        $this->repository_mock
            ->expects($this->once())
            ->method('save');

        $createLibraryService->__invoke(LibraryMother::create());
    }

    public function testItShouldReturnExceptionOnNameNull()
    {
        $this->expectException(InvalidArgumentDomainException::class);
        $createLibraryService = new createLibraryService($this->repository_mock, $this->eventDispatcher_mock);

        $Payload = [
            'description' => 'Fake description',
        ];

        $library_data = createLibraryInputDTO::create($Payload);

        $createLibraryService->__invoke($library_data);
    }

    public function testItShouldReturnExceptionOnDescriptionNull()
    {
        $this->expectException(InvalidArgumentDomainException::class);
        $createLibraryService = new createLibraryService($this->repository_mock, $this->eventDispatcher_mock);

        $Payload = [
            'name' => 'Fake name',
        ];

        $library_data = createLibraryInputDTO::create($Payload);

        $createLibraryService->__invoke($library_data);
    }

    public function testItShouldReturnExceptionOnNameLengthExceed()
    {
        $this->expectException(InvalidArgumentDomainException::class);
        $createLibraryService = new createLibraryService($this->repository_mock, $this->eventDispatcher_mock);

        $Payload = [
            'name' => 'Fake name too big becouse have more than 50 chars and will throw an exception',
            'description' => ' Fake description',
        ];

        $library_data = createLibraryInputDTO::create($Payload);

        $createLibraryService->__invoke($library_data);
    }

    public function testItShouldReturnExceptionOnNameLengthTooShort()
    {
        $this->expectException(InvalidArgumentDomainException::class);
        $createLibraryService = new createLibraryService($this->repository_mock, $this->eventDispatcher_mock);

        $Payload = [
            'name' => 'A',
            'description' => ' Fake description',
        ];

        $library_data = createLibraryInputDTO::create($Payload);

        $createLibraryService->__invoke($library_data);
    }
}
