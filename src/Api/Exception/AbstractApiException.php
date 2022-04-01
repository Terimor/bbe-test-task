<?php

namespace App\Api\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractApiException extends Exception
{
    public function getStatusCode(): int
    {
        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}