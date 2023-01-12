<?php

namespace App\Movie\Domain\Repository;

use App\Library\Domain\Exceptions\InvalidArgumentDomainException;
use App\Library\Domain\Model\Library;
use App\Movie\Adapter\Database\ORM\Doctrine\Repository\DoctrineMovieRepository;
use App\Movie\Domain\Model\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Library>
 *
 * @method Library|null find($id, $lockMode = null, $lockVersion = null)
 * @method Library|null findOneBy(array $criteria, array $orderBy = null)
 * @method Library[]    findAll()
 * @method Library[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends DoctrineMovieRepository
{
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
            throw InvalidArgumentDomainException::createFromMessage('Can not delete user');
        }
    }

    public function findByUuid($uuid)
    {
        $Movie = $this->find($uuid);
        if (is_null($Movie)) {
            throw InvalidArgumentDomainException::createFromMessage('Can not get  user');
        }

        return $Movie;
    }
}
