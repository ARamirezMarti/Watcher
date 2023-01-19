<?php

namespace App\Movie\Application\getMovie;
use App\Movie\Application\getMovie\DTO\getMovieOutputDTO;
use App\Movie\Domain\Repository\MovieRepository;


class getMovieService
{
    public function __construct(public readonly MovieRepository $movieRepository) {
        
    }

    public function __invoke(string $Id): getMovieOutputDTO
    {
        
        $Movie = $this->movieRepository->findByUuid($Id);
        $moviename = $Movie->getMovieName();

        return getMovieOutputDTO::create($Movie->id(),$Movie->getMovieName(),$Movie->getMovieYear(),$Movie->getMovieUrl(),$Movie->getLibraryId()) ;
    }
}
