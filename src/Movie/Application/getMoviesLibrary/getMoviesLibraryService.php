<?php

namespace App\Movie\Application\getMoviesLibrary;
use App\Movie\Domain\Repository\MovieRepository;
use JsonSerializable;
use stdClass;

class getMoviesLibraryService
{
    public function __construct(public readonly MovieRepository $movieRepository){

    }

    public function __invoke(string $uuid): array {

        $Movies = $this->movieRepository->findMoviesByLibraryId($uuid);
        
  
      
        array_map(fn($value):array => $value->jsonSerialize(),$Movies);


        return $Movies;
    }
	
}
