<?php

namespace App\Library\Adapter;

use App\Library\Application\UpdateLibrary\DTO\updateLibraryInputDTO;
use App\Library\Application\UpdateLibrary\DTO\updateLibraryOutputDTO;
use App\Library\Application\UpdateLibrary\updateLibraryService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class updateLibraryController
{
    private $updateLibraryService;

    public function __construct(UpdateLibraryService $updateLibraryService)
    {
        $this->updateLibraryService = $updateLibraryService;
    }

    public function __invoke(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $librarydto = updateLibraryInputDTO::create($data);

        $Library = $this->updateLibraryService->__invoke($librarydto);

        return new JsonResponse(
            updateLibraryOutputDTO::create($Library), JsonResponse::HTTP_OK);
    }
}
