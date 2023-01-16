<?php

namespace App\Movie\Domain\Model;

class MovieUrl
{

    private const BASE_URL =  "/watch/";
    private $url;

    public function __construct(string $Url ) {
        $this->url = self::BASE_URL . $Url;
    }
    

}
