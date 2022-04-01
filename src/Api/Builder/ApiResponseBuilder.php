<?php

namespace App\Api\Builder;

use App\Api\Interfaces\ApiResponseInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponseBuilder
{
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    public function build(ApiResponseInterface $response, int $statusCode = null): JsonResponse
    {
        $data = $this->getResponseBodyAsString($response);
        $responseStatusCode = $statusCode ?: $this->getDefaultStatusCode($response);

        return new JsonResponse(data: $data, status: $responseStatusCode, json: true);
    }

    private function getResponseBodyAsString(ApiResponseInterface $response): ?string
    {
        $context = new SerializationContext();
        $context->setSerializeNull(true);

        return $this->serializer->serialize($response, 'json', $context);
    }

    private function getDefaultStatusCode(ApiResponseInterface $response): int
    {
        return $response->isSuccess() ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}