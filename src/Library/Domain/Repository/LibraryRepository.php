<?php

namespace App\Library\Domain\Repository;

use App\Library\Adapter\Database\ORM\Doctrine\Repository\DoctrineLibraryRepository;
use App\Library\Domain\Exceptions\InvalidArgumentDomainException;
use App\Library\Domain\Model\Library;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Library>
 *
 * @method Library|null find($id, $lockMode = null, $lockVersion = null)
 * @method Library|null findOneBy(array $criteria, array $orderBy = null)
 * @method Library[]    findAll()
 * @method Library[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LibraryRepository extends DoctrineLibraryRepository
{
    public function save(Library $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function delete(Library $entity)
    {
        try {
            $this->getEntityManager()->remove($entity);
            $this->getEntityManager()->flush();
        } catch (\Throwable $th) {
            throw InvalidArgumentDomainException::createFromMessage('User can not be deleted.');
        }
    }

    public function findByUuid($uuid): Library
    {
        $Library = $this->find($uuid);
        if (null === $Library) {
            throw InvalidArgumentDomainException::createFromMessage('Library does not exists.');
        }

        return $Library;
    }

//    /**
//     * @return Library[] Returns an array of Library objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Library
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
