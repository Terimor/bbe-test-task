<?php

namespace App\Api\Exception;

class ApiWrongRequestClassException extends AbstractApiException
{
    private const ERROR_MESSAGE = 'Wrong request class. Expected: %s. Actual: %s.';

    public function __construct(string $expected, string $actual)
    {
        parent::__construct(sprintf(self::ERROR_MESSAGE, $expected, $actual));
    }
}