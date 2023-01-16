<?php

namespace App\Library\Adapter;

use App\Library\Application\CreateLibrary\createLibraryService;
use App\Library\Application\CreateLibrary\DTO\createLibraryInputDTO;
use App\Library\Application\CreateLibrary\DTO\createLibraryOutputDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class createLibraryController extends AbstractController
{
    public function __invoke(Request $request, createLibraryService $createLibraryService)
    {
        $data = json_decode($request->getContent(), true);
        $librarydto = createLibraryInputDTO::create($data);

        $LibrarySaved = $createLibraryService->__invoke($librarydto);

            return new JsonResponse(
            createLibraryOutputDTO::create($LibrarySaved), JsonResponse::HTTP_CREATED);
    }
}
