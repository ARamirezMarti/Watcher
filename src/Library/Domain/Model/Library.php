<?php

namespace App\Library\Domain\Model;

use App\Library\Application\UpdateLibrary\DTO\updateLibraryInputDTO;
use App\Movie\Domain\Model\Movie;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;

class Library
{
    private string $id;
    private LibraryName $name;
    private LibraryDescription $description;

    public function __construct(LibraryName $libraryName, LibraryDescription $libraryDescription)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->name = $libraryName;
        $this->description = $libraryDescription;
    }

    public static function create(LibraryName $libraryName, LibraryDescription $libraryDescription): self
    {
        return new self($libraryName, $libraryDescription);
    }
   

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name->Value();
    }

    public function getDescription(): ?string
    {
        return $this->description->Value();
    }

    /**
     * @param LibraryName $name 
     * @return void
     */
    private function setName(LibraryName $name): void {
        $this->name =  $name;
        
    }
    
    /**
     * @param LibraryDescription $description 
     * @return self
     */
    private function setDescription(LibraryDescription $description): void {
        $this->description = $description;
        
    }

    Public function Update(updateLibraryInputDTO $LibraryDTO){
        $this->name=(new LibraryName($LibraryDTO->name));
        $this->description=(new LibraryDescription($LibraryDTO->description));
    }

/*
    public function getMovies(): ArrayCollection|Collection
    {
        return $this->movie;
    }

    public function addMovie(Movie $Movie):void{

        if(!$this->movies->contains($Movie)){

            $this->movies->add($Movie);
        }

    }

    public function removeMovie(Movie $Movie):void{

        if($this->movies->contains($Movie)){

            $this->movies->removeElement($Movie);
        }

    } */

}
