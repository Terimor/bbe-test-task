<?php

namespace App\Api\Dto\Response;

class ApiSuccessResponseDto extends AbstractApiResponseDto
{
    public function isSuccess(): bool
    {
        return true;
    }
}