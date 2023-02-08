<?php

namespace App\Library\Domain\Repository;

use App\Library\Domain\Model\Library;


interface LibraryRepository 
{
    public function save(Library $entity): void ;
    public function delete(Library $entity);
    public function findByUuid($uuid): Library ;

}
