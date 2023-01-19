<?php

namespace App\Movie\Adapter;

use App\Movie\Application\createMovie\createMovieService;


use App\Movie\Application\createMovie\DTO\createMovieDTO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class createMovieController
{
    

    public function __construct(private createMovieService $createMovieService ) {
    }

    public function __invoke(Request $request){
        $data = json_decode($request->getContent(), true);
        
        $MovieDTO = createMovieDTO::create($data);
        
        $Movie = $this->createMovieService->__invoke($MovieDTO);

        return new JsonResponse([
            "Id"=>$Movie->Id(),
        ], Response::HTTP_CREATED);

    }
}
