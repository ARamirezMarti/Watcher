<?php

namespace App\Library\Adapter;

use App\Library\Application\getLibrary\getLibraryService;
use Symfony\Component\HttpFoundation\JsonResponse;

class getLibraryController
{
    public function __invoke(string $uuid, getLibraryService $getlibraryService)
    {
        $LibraryDTO = $getlibraryService->__invoke($uuid);

        return new JsonResponse(
            $LibraryDTO, JsonResponse::HTTP_OK);
    }
}
