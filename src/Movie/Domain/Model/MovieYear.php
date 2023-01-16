<?php

namespace App\Movie\Domain\Model;

class MovieYear
{

    private $year;

    public function __construct(int $Year){
        $this->year = $Year;

    }

    public function value(): int
    {
        return $this->year;
    }
}
