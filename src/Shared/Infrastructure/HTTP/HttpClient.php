<?php

namespace App\Shared\Infrastructure\HTTP;

use App\Shared\Domain\Bus\Event\IHttpInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class HttpClient implements IHttpInterface
{
    /* 
    *  TODO: Hacer la implementación independiente del cliente es decir, 
    *  crear una implementación generica no para la llamada en concreto 
    */
    
    private $client;
    private const BASE_URL = 'localhost:8000/';

    public function __construct(){

        $this->client = new Client(); 

    }
	public function get(string $url,array $options): ResponseInterface {
        $apiResponse = $this->client->request('GET', self::BASE_URL.$url);
        
 
        
        return $apiResponse;
    }

}
