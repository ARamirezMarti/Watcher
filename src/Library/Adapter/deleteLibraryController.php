<?php

namespace App\Library\Adapter;

use App\Library\Application\DeleteLibrary\deleteLibraryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class deleteLibraryController extends AbstractController
{
    private $deleteLibraryService;

    public function __construct(deleteLibraryService $deleteLibraryService)
    {
        $this->deleteLibraryService = $deleteLibraryService;
    }

    public function __invoke(string $uuid)
    {
        $this->deleteLibraryService->__invoke($uuid);

        return new JsonResponse([
            'status' => 'deleted',
        ], JsonResponse::HTTP_OK);
    }
}
