<?php

namespace App\Movie\Domain\Model;


use App\Movie\Application\createMovie\DTO\createMovieDTO;
use App\Movie\Domain\Model\MovieName;
use App\Movie\Domain\Model\MovieYear;
use App\Movie\Domain\Model\MovieUrl;
use Ramsey\Uuid\Uuid;

class Movie
{

    private string $id;
    private MovieName $MovieName;
    private MovieYear $MovieYear;
    private MovieUrl $MovieUrl;
    private string $LibraryId;

    private function __construct(public MovieName $name, public MovieYear $year, public MovieUrl $url, string $LibraryId)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->MovieName = $name;
        $this->MovieYear = $year;
        $this->MovieUrl = $url;
        $this->LibraryId = $LibraryId;    

    }

    public static function create(createMovieDTO $movieDTO): self
    {
        return new static ($movieDTO->getName(),$movieDTO->getYear(),$movieDTO->getURL(),$movieDTO->getLibraryId());
    }

 

   
}
