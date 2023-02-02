<?php

namespace App\Movie\Domain\Model;

use Ramsey\Uuid\Uuid;

class MovieMeta
{
    private string $id;
    

    private function __construct(
        public Movie $info,
        private string $imdbid,
        private string $title,
        private string $released,
        private string $description,
        private int $score
        
    )
    {
        $this->id = Uuid::uuid4()->toString();
        $this->imdbid = $imdbid;
        $this->title = $title;
        $this->released = $released;
        $this->description = $description;
        $this->score = $score;

    }
    public static function create( string $MovieId,string $imdbid,string $title,string $released, string $description,int $score): self{

        return new self($MovieId, $imdbid, $title, $released, $description, $score);
    }

	public function getId(): string {
		return $this->id;
	}

	public function getImdbid(): string {
		return $this->imdbid;
	}

	public function getTitle(): string {
		return $this->title;
	}

	public function getReleased(): string {
		return $this->released;
	}

	public function getDescription(): string {
		return $this->description;
	}
	public function getScore(): int {
		return $this->score;
	}
}
