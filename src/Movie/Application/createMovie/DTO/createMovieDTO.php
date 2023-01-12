<?php

namespace App\Movie\Application\createMovie\DTO;

use Ramsey\Uuid\Uuid;

class createMovieDTO
{
    private ?string $id = null;
    private ?string $name = null;
    private ?int $year = null;
    private ?string $URL = null;
    private string $library_id;

    public function __construct(string $name, int $year, string $URL, string $library_id)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->name = $name ?: null;
        $this->year = $year ?: null;
        $this->URL = $URL ?: null;
        $this->library_id = $library_id ?: null;
    }

    public static function create(string $name, int $year, string $URL, string $library_id): self
    {
        return new self($name, $year, $URL, $library_id);
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function getURL(): ?string
    {
        return $this->URL;
    }

    public function getLibraryId(): string
    {
        return $this->library_id;
    }
}
