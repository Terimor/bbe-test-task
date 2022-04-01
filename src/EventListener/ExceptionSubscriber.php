<?php

namespace App\EventListener;

use App\Api\Builder\ApiResponseBuilder;
use App\Api\Dto\Response\ApiErrorResponseDto;
use App\Api\Exception\AbstractApiException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Throwable;

class ExceptionSubscriber implements EventSubscriberInterface
{
    private ApiResponseBuilder $responseBuilder;

    public function __construct(ApiResponseBuilder $responseBuilder)
    {
        $this->responseBuilder = $responseBuilder;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $response = new ApiErrorResponseDto();

        $exception = $event->getThrowable();

        $response->setMessage($exception->getMessage());
        $statusCode = $this->getStatusCode($exception);

        $event->setResponse($this->responseBuilder->build($response, $statusCode));
    }

    private function getStatusCode(Throwable $throwable): int
    {
        if ($throwable instanceof AbstractApiException || $throwable instanceof HttpException) {
            return $throwable->getStatusCode();
        }

        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }
}
