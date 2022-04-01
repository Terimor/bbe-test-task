<?php

namespace App\Api\Builder;

use App\Api\Exception\ApiWrongRequestClassException;
use App\Api\Interfaces\ApiRequestInterface;
use JMS\Serializer\SerializerInterface;

class ApiRequestBuilder
{
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    public function build(string $requestClass, string $data): ApiRequestInterface
    {
        $request = $this->serializer->deserialize($data, $requestClass, 'json');
        if ($requestClass !== $request::class) {
            throw new ApiWrongRequestClassException(expected: $requestClass, actual: $request::class);
        }

        return $request;
    }
}