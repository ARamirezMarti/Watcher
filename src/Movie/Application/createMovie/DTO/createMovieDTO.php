<?php

namespace App\Movie\Application\createMovie\DTO;


class createMovieDTO
{

    public function __construct(public readonly string|null $name, public readonly  int | null $year,  public readonly string|null $LibraryId)
    {
     
    }


    public static function create($data): self
    {
        $name = $data['name'] ?? null;
        $year = $data['year'] ?? null;
        $LibraryId = $data['LibraryId'] ?? null;

        return new self($name, $year, $LibraryId);
    }
   

}
