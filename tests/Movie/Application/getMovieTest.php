<?php

namespace App\Movie\Application;
use App\Library\Domain\Exceptions\InvalidArgumentDomainException;
use App\Movie\Application\getMovie\getMovieService;
use App\Movie\Domain\Repository\MovieRepository;
use App\Movie\Application\createMovie\createMovieService;
use App\Movie\Application\createMovie\DTO\createMovieDTO;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;


class getMovieTest extends TestCase
{
    private $MovieRepository_mock;
    public function setUp(): void {
        parent::setUp();
        $this->MovieRepository_mock = $this->createMock(MovieRepository::class);
    }

    public function testItShouldReturnAMovie()
    {
        $Payload = [
            'name' => 'Fake Movie name',
            'year' => 1990,
            'LibraryId' => '52dcf442-d1b1-470b-a5a0-6d99a19906ba',
        ];

        $MovieDTO = createMovieDTO::create($Payload);
        $createMovieService = new createMovieService($this->MovieRepository_mock);

        $this->MovieRepository_mock
            ->expects($this->once())
            ->method('save');

        $MovieCreated = $createMovieService->__invoke($MovieDTO);

        $getMovieService = new getMovieService($this->MovieRepository_mock);

        
        
        $this->MovieRepository_mock
            ->expects($this->once())
            ->method("findByUuid")
            ->with($MovieCreated->id())
            ->willReturn($MovieCreated);
       
        $getMovie = $getMovieService->__invoke($MovieCreated->id());
        $this->assertEquals($MovieCreated->id(),$getMovie->id);

    }

    public function testItShouldReturnExceptionOnNonExistingUuid(){
        $this->expectException(InvalidArgumentDomainException::class);

        $randomUuid = Uuid::uuid4()->toString();
        $getMovieService = new getMovieService($this->MovieRepository_mock);

        $this->MovieRepository_mock
            ->expects($this->once())
            ->method("findByUuid")
            ->with($randomUuid)
            ->willThrowException(new InvalidArgumentDomainException());
       
        $getMovie = $getMovieService->__invoke($randomUuid);

    }
}
