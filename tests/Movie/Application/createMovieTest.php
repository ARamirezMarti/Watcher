<?php

namespace App\Movie\Application;

use App\Movie\Application\createMovie\createMovieService;
use App\Movie\Application\createMovie\DTO\createMovieDTO;
use App\Movie\Domain\Repository\MovieRepository;
use PHPUnit\Framework\TestCase;

class createMovieTest extends TestCase
{
    private $MovieRepository_Mock;

    public function setUp(): void
    {
        parent::setUp();
        $this->MovieRepository_Mock = $this->createMock(MovieRepository::class);
    }

    public function testMovieIsCreated()
    {
        $Payload = [
            'name' => 'Fake Movie name',
            'year' => 1990,
            'LibraryId' => '52dcf442-d1b1-470b-a5a0-6d99a19906ba',
        ];

        $MovieDTO = createMovieDTO::create($Payload);
        $createMovieService = new createMovieService($this->MovieRepository_Mock);

        $this->MovieRepository_Mock
            ->expects($this->once())
            ->method('save');

        $createMovieService->__invoke($MovieDTO);
    }
}
