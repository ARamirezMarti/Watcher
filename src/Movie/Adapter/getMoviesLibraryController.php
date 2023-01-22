<?php

namespace App\Movie\Adapter;
use App\Movie\Application\getMoviesLibrary\getMoviesLibraryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class getMoviesLibraryController extends AbstractController
{
    public function __construct(public readonly getMoviesLibraryService $getMoviesLibraryService)
    {}
    
    public function __invoke($uuid){


        $Movies =   $this->getMoviesLibraryService->__invoke($uuid);
        
        return new JsonResponse(
            $Movies
        ,Response::HTTP_OK);
    }
}
