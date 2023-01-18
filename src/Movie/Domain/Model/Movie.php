<?php

namespace App\Movie\Domain\Model;


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

    private function __construct(MovieName $name,  MovieYear $year, MovieUrl $movieUrl, string $LibraryId)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->MovieName = $name;
        $this->MovieYear = $year;
        $this->MovieUrl = $movieUrl;
        $this->LibraryId = $LibraryId;    

    }

    public static function create(MovieName $movieName,MovieYear $movieYear,MovieUrl $movieUrl, string $LibraryId): self
    {
        return new static ($movieName,$movieYear,$movieUrl,$LibraryId);
    }

 

   
}
