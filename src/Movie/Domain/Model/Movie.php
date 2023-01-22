<?php

namespace App\Movie\Domain\Model;


use App\Movie\Domain\Model\MovieName;
use App\Movie\Domain\Model\MovieYear;
use App\Movie\Domain\Model\MovieUrl;
use JsonSerializable;
use Ramsey\Uuid\Uuid;
use App\Library\Domain\Exceptions\InvalidArgumentDomainException;

class Movie implements JsonSerializable
{

    private string $id;
    private MovieName $MovieName;
    private MovieYear $MovieYear;
    private MovieUrl $MovieUrl;
    private string $LibraryId;

    private function __construct(MovieName $name,  MovieYear $year, MovieUrl $movieUrl, string|null $LibraryId)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->MovieName = $name;
        $this->MovieYear = $year;
        $this->MovieUrl = $movieUrl;
        

        $this->checkLibraryIdIsAdded($LibraryId);
        $this->LibraryId = $LibraryId;    

    }

    public static function create(MovieName $movieName,MovieYear $movieYear,MovieUrl $movieUrl, string | null $LibraryId): self
    {
        return new static ($movieName,$movieYear,$movieUrl,$LibraryId);
    }

    private  function checkLibraryIdIsAdded( $LibraryId): void
    {
        if(null==$LibraryId){
            throw InvalidArgumentDomainException::createFromMessage('LibraryId can not be null');

        }
    }

    public function Id(): string
    {
        return $this->id;
    }


	public function getMovieName(): MovieName {
		return $this->MovieName;
	}


	public function getMovieYear(): MovieYear {
		return $this->MovieYear;
	}

	public function getMovieUrl(): MovieUrl {
		return $this->MovieUrl;
	}

	/**
	 * @return string
	 */
	public function getLibraryId(): string {
		return $this->LibraryId;
	}

    	
	public function jsonSerialize() {
        return [
            "id"    => $this->Id(),
            "name"  => $this->getMovieName()->Value(),
            "url"   => $this->getMovieUrl()->Value()

        ];
	}
}
