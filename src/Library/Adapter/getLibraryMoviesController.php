<?php

namespace App\Library\Adapter;

use App\Library\Application\getLibraryMovies\getLibraryMoviesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class getLibraryMoviesController extends AbstractController
{
    public function __invoke($uuid, getLibraryMoviesService $getLibraryMoviesService){


        $Movies = $getLibraryMoviesService->__invoke($uuid);
        
        return new JsonResponse([
            "Movies" => $Movies],
            Response::HTTP_ACCEPTED
        );
    }

}
