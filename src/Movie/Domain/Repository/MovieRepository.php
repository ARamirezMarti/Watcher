<?php

namespace App\Movie\Domain\Repository;

use App\Movie\Domain\Model\Movie;

interface  MovieRepository
{
    public function save(Movie $entity, bool $flush = false): void;

    public function delete(Movie $entity);

    public function findByUuid($uuid): Movie ;

    public function findMoviesByLibraryId($uuid): array; 
   
}
