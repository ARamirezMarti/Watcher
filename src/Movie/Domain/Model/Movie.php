<?php

namespace App\Movie\Domain\Model;

use App\Movie\Application\createMovie\DTO\createMovieDTO;

class Movie
{
    public const BASE_URL = '/watch/';

    private function __construct(public string $id, public string $name, public int $year, public string $URL, public string $libraryId)
    {
        $this->check_Name($name);
        $this->modify_Url($URL);
    }

    public static function create(createMovieDTO $movieDTO): self
    {
        return new static ($movieDTO->getId(),$movieDTO->getName(),$movieDTO->getYear(),$movieDTO->getURL(),$movieDTO->getLibraryId());
    }

    public function check_Name(string $name)
    {
    }

    public function modify_Url($url)
    {
        $this->URL = self::BASE_URL.$url;
    }
}
