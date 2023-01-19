<?php

namespace App\Movie\Application\getMovie\DTO;
use App\Movie\Domain\Model\MovieName;
use App\Movie\Domain\Model\MovieUrl;
use App\Movie\Domain\Model\MovieYear;

class getMovieOutputDTO
{

    private function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string| null $year,
        public readonly string $url,
        public readonly string $LibraryId,
        ){

    }

    public static function create(
        string $id,
        MovieName $name,
        MovieYear|null $year,
        MovieUrl $url,
        string $LibraryId,
    ){

        return new self($id, $name->Value(), $year->value(),$url->Value(), $LibraryId);
    }
}
