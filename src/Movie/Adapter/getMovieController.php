<?php

namespace App\Movie\Adapter;
use App\Movie\Application\getMovie\getMovieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class getMovieController extends AbstractController
{


    public function __invoke(string $uuid, getMovieService $getMovieService){

        $Movie = $getMovieService->__invoke($uuid);

        return new JsonResponse([ "movie"=>$Movie], Response::HTTP_OK);
        
    }

}
