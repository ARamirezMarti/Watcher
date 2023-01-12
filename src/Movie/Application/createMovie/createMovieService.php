<?php

namespace App\Movie\Application\createMovie;

use App\Movie\Application\createMovie\DTO\createMovieDTO;
use App\Movie\Domain\Model\Movie;
use App\Movie\Domain\Repository\MovieRepository;

class createMovieService
{
    public function __construct(private MovieRepository $movieRepository)
    {
    }

    public function __invoke(createMovieDTO $createMovieDTO)
    {
        $Movie = Movie::create($createMovieDTO);
        $this->movieRepository->save($Movie);
    }
}
