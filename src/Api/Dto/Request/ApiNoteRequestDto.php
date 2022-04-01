<?php

namespace App\Api\Dto\Request;

use App\Api\Interfaces\ApiRequestInterface;
use JMS\Serializer\Annotation\Type;

class ApiNoteRequestDto implements ApiRequestInterface
{
    #[Type("string")]
    private string $note;

    public function getNote(): string
    {
        return $this->note;
    }
}