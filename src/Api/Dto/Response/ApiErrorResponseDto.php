<?php

namespace App\Api\Dto\Response;

use JMS\Serializer\Annotation\Type;

class ApiErrorResponseDto extends AbstractApiResponseDto
{
    #[Type('string')]
    private string $message;

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function isSuccess(): bool
    {
        return false;
    }
}