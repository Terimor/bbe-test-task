<?php

namespace App\Api\Dto\Response;

use App\Api\Interfaces\ApiResponseInterface;
use JMS\Serializer\Annotation\Type;

class AbstractApiResponseDto implements ApiResponseInterface
{
    #[Type("bool")]
    private bool $success = true;

    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }
}