<?php

namespace App\Shared\Infrastructure\Listener;

use App\Library\Domain\Exceptions\InvalidArgumentDomainException;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonTransformerExceptionListener
{
    public function onKernelException(ExceptionEvent $exceptionEvent){

        $e = $exceptionEvent->getThrowable();
        

        $JsonResponse = [
            'class' => \get_class($e),
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $e->getMessage(),
        ];
        
        if ($e instanceof ResourceNotFoundException) {
            $JsonResponse['code'] = Response::HTTP_NOT_FOUND;
        }

        if ($e instanceof InvalidArgumentException) {
            $JsonResponse['code'] = Response::HTTP_BAD_REQUEST;
        }

        if ($e instanceof AccessDeniedException) {
            $JsonResponse['code'] = Response::HTTP_FORBIDDEN;
        }

        if ($e instanceof InvalidArgumentDomainException) {
            $JsonResponse['code'] = Response::HTTP_CONFLICT;
        }
        $response = new JsonResponse($JsonResponse, $JsonResponse['code']);

        $exceptionEvent->setResponse($response);
        
    }
}
