<?php

namespace App\Movie\Adapter\Database\ORM\Doctrine\Repository;

use App\Movie\Domain\Model\Movie;
use App\Movie\Domain\Repository\MovieRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineMovieRepository extends ServiceEntityRepository implements MovieRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function save(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function delete(Movie $entity)
    {
        try {
            $this->getEntityManager()->remove($entity);
            $this->getEntityManager()->flush();
        } catch (\Throwable $th) {
            throw InvalidArgumentDomainException::createFromMessage('Can not delete movie');
        }
    }

    public function findByUuid($uuid): Movie
    {
        $Movie = $this->find($uuid);
        if (is_null($Movie)) {
            throw InvalidArgumentDomainException::createFromMessage('Can not get  movie');
        }

        return $Movie;
    }
    public function findMoviesByLibraryId($uuid): array
    {
        $Movies = $this->findBy(['LibraryId'=>$uuid]);

        if(null == $Movies){
            return null;
        }

        return $Movies;



    }
}