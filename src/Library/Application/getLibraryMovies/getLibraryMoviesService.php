<?php

namespace App\Library\Application\getLibraryMovies;
use App\Shared\Domain\Bus\Event\IHttpInterface;

class getLibraryMoviesService
{
    private $HttpClient;
    public function __construct(IHttpInterface $HttpClient){

        $this->HttpClient = $HttpClient;
    }

    public function __invoke($uuid)
    {
      
        $Response = $this->HttpClient->get("movie/{$uuid}/library",[]);
        
        return \json_decode( $Response->getBody()->getContents());
    }
}
