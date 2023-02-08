<?php

namespace App\Library\Adapter\Database\ORM\Doctrine\Repository;

use App\Library\Domain\Model\Library;
use App\Library\Domain\Repository\LibraryRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineLibraryRepository extends ServiceEntityRepository implements LibraryRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Library::class);
    }

    public function save(Library $entity): void
    {
        
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function delete(Library $entity)
    {
        try {
            $this->getEntityManager()->remove($entity);
            $this->getEntityManager()->flush();
        } catch (  \Exception $e  ) {
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
}
